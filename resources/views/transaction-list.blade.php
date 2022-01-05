@section('title')
  {{'Transaction List'}}
@endsection
@extends('layouts.layout')
@section('main_content')
<div class="card-header">
    <h3 class="card-title">Transaction List</h3>
  </div>
  <div class="card-body">
    <table class="table table-hover text-nowrap">
        <thead>
            <th>S.N</th>
            <th>Product Name</th>
            <th>User Name</th>
            <th>Quantity</th>
            <th>Transaction Type</th>
        </thead>
      {{-- @dd($transctions[0]->products->name) --}}
        <tbody>
            @foreach ($transactions as $key => $item)
            <tr>
                <td> {{$key++}}</td>
                <td >{{$item->products->name}}</td>
                <td >{{$item->users->name ?? 'None'}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->transaction_type}}</td>
            </tr>
            @endforeach

        </tbody>
    
      </table>
  </div>
@endsection
 