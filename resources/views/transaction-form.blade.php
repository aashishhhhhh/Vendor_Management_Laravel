@section('title')
  {{'Transaction Form'}}
@endsection
@extends('layouts.layout')
@section('main_content') 
    @livewire('show-posts',['users'=>$users]) 
@endsection
 
