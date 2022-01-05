@section('title')
  {{'Bought Product List'}}
@endsection
@extends('layouts.layout')
@section('main_content')
<div class="datediv">
    <form action="{{url('showtransactedProduct')}}" method="POST">
        @csrf
        <h3 class="vendorDate">Pick a Transaction Date</h3>
        <label> From </label>
        <input type="date" name="from">
        <label> To </label>
        <input type="date" name="to">
        <a> <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-fw"></i></button> </a>
    </form>
    

</div>

@if (count($transactions)>0)
<div class="card-header">
    <h3 class="card-title">Bought Product List</h3>
  </div>

<table class="table table-hover text-nowrap">
    <thead>
        <th>Product Name</th>
        <th>Quantity</th>
    </thead>
    <tbody>
      @foreach ($transactions as $item)
      <tr>
        <td>{{$item->products->name}}</td>
        <td>{{$item->quantity}}</td>
      </tr>
      @endforeach
    </tbody>
  </table> 
  @else
    <h3>You havenot brought any products yet</h3>
@endif
@endsection