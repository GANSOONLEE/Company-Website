@extends('frontend.layouts.app')

@section('title', __('Type'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\type.css')}}">
@endpush

@section('content')

        <div class="org">
            <img src="" alt="origin">
        </div>
        <div class="china">
            <img src="" alt="china">
        </div>

@endsection

@push('after-script')
    
@endpush