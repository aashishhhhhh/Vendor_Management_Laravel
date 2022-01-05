@section('title')
  {{'Add Product'}}
@endsection
@extends('layouts.layout')
@section('main_content')

<div class="card-header">
    <h3 class="card-title">Add Product</h3>
  </div>
  <div class="card-body">
<form id="quickForm" method="POST" action="{{url('addProduct')}}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Product Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Product Name">
            <small>
              @error('name')
                  {{$message}}
              @enderror
            </small>
        </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Quantity</label>
        <input type="text"  name="quantity" class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity">
        <small>
          @error('quantity')
              {{$message}}
          @enderror
        </small>
      </div>
      
        <!-- select -->
        <div class="form-group">
          <label>Select Category</label>
          <select name='category[]'class="form-control multiple-select" multiple>
              @foreach ($datas as $item)
            <option value="{{$item->id}}" > {{$item->name}} </option>
            @endforeach
          </select>
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
 