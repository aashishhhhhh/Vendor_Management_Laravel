@section('title')
  {{'Add Category'}}
@endsection
@extends('layouts.layout')

@section('main_content')
<div class="card-header">
    <h3 class="card-title">Add Categoty</h3>
  </div>
  <div class="card-body">
<form id="quickForm" method="POST" action="{{url('addCategory')}}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Category Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Category">
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
     <a> <button type="submit" class="btn btn-primary">Submit</button> </a>
    </div>
  </form>
  </div>
@endsection
 