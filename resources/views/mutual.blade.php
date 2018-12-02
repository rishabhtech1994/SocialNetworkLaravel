@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mutual Friend
                  <div class="panel-body">
                   <div class="col-sm-6 col-md-12">
                      @foreach($friend_array_merge2 as $mutual_fri)
                      <div class="col-md-4" style="margin: 5px">
                          <div class="thumbnail" >
                            <h2 align="center"> {{$mutual_fri->name}}</h2>

                              <p align="center"><b>Email:</b> {{$mutual_fri->email}}</p>

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
