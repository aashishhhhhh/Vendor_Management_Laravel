@section('title')
  {{'Bought Product List'}}
@endsection
@extends('layouts.layout')
@section('main_content')
@livewire('vendor-product-list',['transactions'=>$transactions])

@endsection