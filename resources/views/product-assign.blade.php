@section('title')
  {{'Assign Product'}}
@endsection
@extends('layouts.layout')
@section('main_content')
<div class="card-header">
  @if (Session::has('msg'))
  <h2 style="color: red" > {{Session::get('msg')}} </h2>     
  @endif
 
    <h3 class="card-title">Assign Product</h3>
  </div>
  <div class="card-body">
<form id="quickForm" method="POST" action="{{url('assignProduct')}}">
    @csrf
    <div class="card-body">
         <!-- select -->
         <div class="form-group">
            <label>Select Product</label>
            <select name='product' class="form-control">
                @foreach ($datas as $item)
              <option value="{{$item->id}}" > {{$item->name}} </option>
              @endforeach
            </select>
          </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Quantity</label>
        <input type="number"  name="quantity" class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity">
        <input type="hidden"  name="userid" value="{{$id}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Quantity">

        <small>
          @error('quantity')
              {{$message}}
          @enderror
        </small>
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
