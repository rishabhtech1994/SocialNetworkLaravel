@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>My pending requests!!</b>
                  <div class="panel-body">
                   <div class="col-sm-6 col-md-12">
                     @if(session()->has('msg'))
                           <p> {{session()->get('msg')}}</p>

                    @endif
                     @foreach($friendrequest as $frequest)
                     <div class="col-md-4" style="margin: 5px">
                         <div class="thumbnail" >
                           <h2 align="center"> {{$frequest->name}}</h2>
                             <p align="center"><b>Email:</b> {{$frequest->email}}</p>
                             <div class="caption" align="center">
                               <p> <a href="{{url('/accept')}}/{{$frequest->id}}" class="btn btn-success">Confirm</a>
                                   <a href="{{url('/requestRemove')}}/{{$frequest->id}}" class="btn btn-danger">Remove</a></p>
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
<script>
$.noConflict();
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>



@endsection
