@section('title')
  {{'Edit Category'}}
@endsection
@extends('layouts.layout')
@section('main_content')
<div class="card-header">
    <a id="addCategory" href="{{url('showAddCategory')}}"><button type="button" class="btn btn-primary">Add Category</button> </a>

    <h3 class="card-title">Edit Category</h3>
  </div>
  <div class="card-body">
     
  
<form id="quickForm" method="POST" action="{{url('editCategory')}}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Category Name</label>
            <input type="text" value="{{$datas->name}}" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            <small>
                @error('name')
                    {{$message}}
                @enderror
            </small>
          </div>
        <input type="hidden" value="{{$datas->id}}" name="id" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
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
 