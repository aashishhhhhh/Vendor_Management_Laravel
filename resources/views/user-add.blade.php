@section('title')
  {{'Add User'}}
@endsection
@extends('layouts.layout')
@section('main_content')
<div class="card-header">
    <h3 class="card-title">Add User</h3>
  </div>
  <div class="card-body">
<form id="quickForm" method="POST" action="{{url('addUser')}}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
            <small>
              @error('name')
                  {{$message}}
              @enderror
            </small>
          </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email"  name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
        <small>
          @error('email')
              {{$message}}
          @enderror
        </small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        @error('password')
        {{$message}}
        @enderror
      </div>
      <div class="form-group mb-0">
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
     <a> <button type="submit" class="btn btn-primary">Submit</button> </a>
    </div>
  </form>
  </div>
@endsection
 