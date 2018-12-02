@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User List!! Find Friends
                  <div class="panel panel-default">
                  <div class="panel-heading">{{Auth::user()->names}}</div>
                  <div class="panel-body">
                   <div class="col-sm-6 col-md-12">
                      @foreach ($users_rest as $urest)
                      <div class="col-md-4" style="margin: 10px">
                        <div class="thumbnail" >
                          <h2 align="center"> <a href="{{url('/mutualFriend')}}/{{$urest->id}}">{{$urest->name}}</a></h2>
                          <div class="caption" align="center">

                                <p> {{$urest->email}}</p>
                                <?php
                                        $check=DB::table('friendships')
                                        ->where('user_requested','=',$urest->id)
                                        ->where('requestor','=',Auth::user()->id)
                                        ->first();
                                    if($check==''){
                                    ?>

                                <p> <a href="{{url('/addFriend')}}/{{$urest->id}}" class="btn btn-info">Add to Friend</a></p>
                                <hr>
                              <?php }
                                else{ ?>

                              <p> Request Already sent</p>
                              <hr>
                        <?php }?>

                          </div>
                        </div>
                      </div>
                      @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>
</div>
@endsection
