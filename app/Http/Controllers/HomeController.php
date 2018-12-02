<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use App\friendships;
use DB;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

  /*  public function showall(){
      $users=User::all();
      return view('showall',compact('users'));
    }*/

    public function findFriends(){

      $present_uid=Auth::user()->id;
      $users_rest=DB::table('users')->where('id','!=',$present_uid)->get();


      return view('showall',compact('users_rest'));
    }

//function of sending friend Request
public function sendRequest($id){
          Auth::user()->addFriend($id); //trait in Freindable
            return back();
        }

        public function showincomingrequest(){
          $uid=Auth::user()->id;
          $friendrequest = DB::table('friendships')
                        ->rightJoin('users', 'users.id', '=', 'friendships.requestor')
                        ->where('status', '=', 0)
                        ->where('friendships.user_requested', '=', $uid)->get();

        return view('request',compact('friendrequest'));
        }

//function of accepting friend request
public function acceptrequest($id){
        $uid=Auth::user()->id;
        $check_request=friendships::where('requestor',$id)
                        ->where('user_requested',$uid)
                        ->first();
                        //  console.log("qwertyuiop");
        if($check_request){
         $updateFriendship= DB::table('friendships')
                     ->where('user_requested', $uid)
                     ->where('requestor', $id)
                     ->update(['status' => 1]);

            if($updateFriendship){
              return back()->with('msg','You are now friend with this User');
            }
          }
              else{
             return back()->with('msg','Something went wrong!!');
        }
      }

//
public function friends(){
        $uid=Auth::user()->id;
        $friend_requset_sender_to_present_user=DB::table('friendships')
                                            ->leftJoin('users','users.id','friendships.user_requested')//not loggedin user
                                            ->where('status',1)
                                            ->where('requestor',$uid) //logged in user
                                            ->get();
        //dd($friend_requset_sender_to_present_user);
       // $friend_requset_send
        $friend_requset_send_by_the_present_user=DB::table('friendships')
                                            ->leftJoin('users','users.id','friendships.requestor')
                                            ->where('status',1)
                                            ->where('user_requested',$uid)
                                            ->get();
        //dd($friend_requset_send_by_the_present_user);

        $friend_array_merge=array_merge($friend_requset_sender_to_present_user->toArray(),$friend_requset_send_by_the_present_user->toArray());
        //dd($friend_array_merge);
        return view('friend',compact('friend_array_merge'));

}

//removing friend from the list
public function requestRemove($id){
      DB::table('friendships')
          ->where('user_requested',Auth::user()->id)
          ->where('requestor',$id)
          ->delete();
      return back()->with('msg','User Successfully Removed');

}

//Showing mutual friends
public function mutualFriend($id){
      $u_id=Auth::user()->id; //present user id

      $my_friend=DB::table('friendships')
                          ->where('requestor', '=',$u_id)
                          ->where('status', '=',1)
                          ->get();
      $my_friend1=$my_friend->pluck('user_requested');
      //$myfriend2=serialize($my_friend1);
                      //dd($my_friend1);
        $friend_id=DB::table('friendships')
                          ->where('requestor', '=',$id)
                          ->where('status', '=',1)
                          ->get();
      $friend_id1=$friend_id->pluck('requestor');
      $friend_array_merge1=array_merge($my_friend1->toArray(),$friend_id1->toArray());
      //dd($friend_array_merge1);
      //$friend_array_merge2=serialize($friend_array_merge1);
      for ($i=0; $i <count($friend_array_merge1) ; $i++) {


      $friend_array_merge2=DB::table('friendships')
            ->join('users','users.id','=','friendships.requestor')
            ->where('users.id',$friend_array_merge1[$i])
            ->where('status',1)
            ->get();
      }
    return view('mutual',compact(['my_friend','friend_id','friend_array_merge2']));

}


}
