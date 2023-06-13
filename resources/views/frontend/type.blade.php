@extends('frontend.layouts.app')

@section('title', __('Type'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\type.css')}}">
@endpush

@section('content')

        <div class="org">
            <img src="" alt="origin">
            <a href="/origin/catelog"><button class="typeBtn">origin</button></a>
        </div>
        <div class="china">
            
            <img src="" alt="china">
            <a href="/non-origin/catelog"><button class="typeBtn">non-origin</button></a>
        </div>

@endsection

@push('after-script')
    
@endpush