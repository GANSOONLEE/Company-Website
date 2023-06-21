
@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\register.css')}}">
    
@endpush

@push('before-body')
    
@endpush

@section('content')

<form action="{{route('frontend.login.post')}}" method="POST" class="form">
    @csrf
    <div class="part" data-index='1' data-visible='true'>
        <div class="section-form">
            <label for="email"><span class="requird">Name:</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="section-form">
            <label for="password"><span class="requird">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="button-area">
            <button type="submit" data-button-identify="submit">Login</button>
        </div>
    </div>

@endsection
