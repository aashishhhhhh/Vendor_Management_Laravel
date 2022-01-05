@section('title')
  {{'Edit Product'}}
@endsection
@extends('layouts.layout')
@section('main_content')
<div class="card-header">
    <h3 class="card-title">Edit User</h3>
  </div>
  <div class="card-body">
  
<form id="quickForm" method="POST" action="{{url('editProduct')}}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Product Name</label>
            <input type="text" value="{{$datas->name}}" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
          </div>
        <input type="hidden" value="{{$datas->id}}" name="id" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      <div class="form-group">
        <label for="exampleInputEmail1">Product Quantity</label>
        <input type="text" value="{{$datas->quantity}}" name="quantity" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
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
 