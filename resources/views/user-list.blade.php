@section('title')
  {{'User List'}}
@endsection

@extends('layouts.layout')

@section('main_content')
<div class="card-header">
  <a id="addUser" href="{{url('showAddUser')}}"><button type="button" class="btn btn-primary">Add User</button> </a>

    <h3 class="card-title">User List</h3>
  </div>
  <div class="card-body">
<table class="table table-hover text-nowrap">
    <thead>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </thead>
    @foreach ($datas as $item)
    <tbody>
        <tr>
           <td> {{$item->name}} </td>
           <td> {{$item->email}}</td>
           <td> Normal </td>
            <td>
             <a href="{{url('showedit/'.$item->id)}}"> <button type="button" class="btn btn-primary">Edit</button> </a>
              <a href="{{url('deleteUser/'.$item->id)}}">  <button type="button" class="btn btn-danger">Delete</button> </a>
              <a href="{{url('showAssignProduct/'.$item->id)}}">  <button type="button" class="btn btn-primary">Assign Product</button> </a>
            </td>
        </tr>

    </tbody>
    @endforeach

  </table>
  </div>
@endsection