@extends('page._layouts.main')
@section('title', 'Home')

@section('header')
    <div class="header-container">
        <div class="bg-black-sh"></div>
        <div class="container">
            <div class="header-content-text">
                <p class="p-0 m-0" style="font-size: 36px">Selamat Datang di</p>
                <p class="text-app-secondary" style="font-size: 48px;">Perpusku</p>
            </div>
        </div>
        <img class="w-100 h-100" style="object-fit: cover; object-position: center"
            src="{{ asset('bg-1.jpeg') }}" alt="" srcset="">
    </div>
@endsection
