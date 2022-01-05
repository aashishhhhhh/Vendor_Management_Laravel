@section('title')
  {{'Category List'}}
@endsection
@extends('layouts.layout')
@section('main_content')
<div class="card-header">
    <a id="addCategory" href="{{url('showAddCategory')}}"><button type="button" class="btn btn-primary">Add Category</button> </a>

    <h3 class="card-title">Category List</h3>
  </div>
<table class="table table-hover text-nowrap">
    <thead>
        <th>Category Name</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($datas as $item)
            
        <tr>
           <td> {{$item->name}} </td>
            <td>
             <a href="{{url('showCategoryedit/'.$item->id)}}"> <button type="button" class="btn btn-primary">Edit</button> </a>
             <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger{{$item->id}}"> Delete </Button>
              <a href="{{url('showCategoryProducts/'.$item->id)}}">  <button type="button" class="btn btn-primary">Show Products</button> </a>
              {{-- <a href="{{url('deleteCategory/'.$item->id)}}">  <button type="button" class="btn btn-danger">Delete</button> </a> --}}
            </td>
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
                    <a href="{{url('deleteCategory/'.$item->id)}}">  <button type="button" class="btn btn-outline-light">Yes</button> </a>

                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
        </tr>
        @endforeach

    </tbody>

  </table> 
@endsection