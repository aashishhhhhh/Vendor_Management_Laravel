@section('title')
  {{'Transaction Form'}}
@endsection
@extends('layouts.layout')
@section('main_content')

    <div class="card-header">
      <h3 class="card-title">Pick Transaction Date</h3>
    </div>
    <div class="card-body">
      <form id="quickForm" method="POST" action="{{url('showTransaction')}}">
        @csrf
        <div class="form-group">
          <div class="col-4">
            <p>From</p>
            <input type="date" class="form-control " name="from" id="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-4">
            <p>To</p>
            <input type="date" class="form-control " name="to" id="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-4">

          <p>Pick User</p>
        <select name='user'class="form-control">
          <option value="none" selected disabled hidden>Select an Option</option>
            @foreach ($user as $item)
          <option value="{{$item->id}}" > {{$item->name}} </option>
          @endforeach
        </select>
      </div>
      
      </div>
      <div class="form-group">
        <a> <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-fw"></i></button> </a>
       <a href="showTransaction"></a> 
      </div>
      </form>
      @if (Session::has('list'))
      {{Session::forget('list')}}
              @if (count($transactions)<1)
              <h3> No data found </h3>      
              @else         
              <table class="table table-hover text-nowrap">
                <h3>Transaction Table</h3>
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
     
      @endif
      @endif
      </div>
 
@endsection
 