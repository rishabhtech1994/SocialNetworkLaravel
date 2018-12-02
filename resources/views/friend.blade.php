@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>My Friend List</b>
                  <div class="panel-body">
                   <div class="col-sm-6 col-md-12">
                        @if(session()->has('msg'))
                            <p> {{session()->get('msg')}}</p>

                        @endif
                        @foreach($friend_array_merge as $FriendList)
                        <div class="col-md-4" style="margin: 5px">
                           	<div class="thumbnail" >
                           		<h2 align="center"> {{$FriendList->name}}</h2>
                                 <p align="center"><b>Email:</b> {{$FriendList->email}}</p>
                                  <div class="caption" align="center">
                                    <a href="" class="btn btn-danger">UnFriend</a></p>
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




@endsection
