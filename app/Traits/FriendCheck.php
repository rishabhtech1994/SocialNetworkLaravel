<?php

namespace App\Traits;
use App\friendships;
use Auth;
trait FriendCheck{
	public function test(){
		return 'hi' ;
	}

	public function addFriend($id){

		$Friend=friendships::create([
			'requestor'=>$this->id,
			'user_requested'=>$id,
			'status'=>0,

		]);

		if($Friend){
			return $Friend;
		}

		return 'failed';
	}
}
