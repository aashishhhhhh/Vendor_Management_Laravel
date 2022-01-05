@section('title')
  {{'Product List'}}
@endsection

@extends('layouts.layout')
@section('main_content')
<div class="card-header">
  <a id="addProduct" href="{{url('showAddProduct')}}"><button type="button" class="btn btn-primary">Add Product</button> </a>
  <h3 class="card-title">Product List</h3>
</div>
<table class="table table-hover text-nowrap">
    <thead>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Action</th>

    </thead>
    <tbody>
      @foreach ($datas as $item)
        <tr>
           <td> {{$item->name}} </td>
           <td> {{$item->quantity}}  </td>
            <td>
            
             <a href="{{url('showProductedit/'.$item->id)}}"> <button type="button" class="btn btn-primary">Edit</button> </a>
        
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger{{$item->id}}">
                Delete
              </button>
              <a href="{{url('showQuantityAdd/'.$item->id)}}"> <button type="button" class="btn btn-primary">Add Quantity</button> </a>
            </td>
        </tr>
        <div class="modal fade" id="modal-danger{{$item->id}}" style="display: none;" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content bg-danger">
              <div class="modal-header">
                <h4 class="modal-title">Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p>You want to Delete this Product?</p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                <a href="{{url('deleteProduct/'.$item->id)}}">  <button type="button" class="btn btn-outline-light">Yes</button> </a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        @endforeach
    </tbody>
  </table> 
@endsection