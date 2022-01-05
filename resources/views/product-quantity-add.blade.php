@section('title')
  {{'Product Quantity'}}
@endsection

@extends('layouts.layout')

@section('main_content')
<div class="card-header">
    <h3 class="card-title">Add User</h3>
  </div>
  <div class="card-body">
<form id="quickForm" method="POST" action="{{url('quantityAdd')}}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Add Quantity</label>
            <input type="number" name="quantity" class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity">
            <input type="hidden" value="{{$id}}" name="id" class="form-control" id="exampleInputPassword1" placeholder="Password">
            <small>
              @error('name')
                  {{$message}}
              @enderror
            </small>
          </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
     <a> <button type="submit" class="btn btn-primary">Submit</button> </a>
    </div>
  </form>
  </div>
@endsection