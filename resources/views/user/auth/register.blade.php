@extends('user._layouts.auth')
@section('title', 'Register')
@section('css')
    <style>
      .text-danger{
        color: #dc3545;
        font-size: 11px;
      }
    </style>
@endsection
@section('content')
<div class="container">
  @livewire('register-form')
</div> 
@endsection
