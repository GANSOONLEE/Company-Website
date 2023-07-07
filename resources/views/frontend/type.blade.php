@extends('frontend.layouts.app')

@section('title', __('Type'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\type.css')}}">
@endpush

@section('content')

        <div class="product-type org">
            <a href="/origin/catelog"><button class="typeBtn">Original</button></a>
            <img class="img-type" src={{ asset('image\original.png') }} alt="origin">
        </div>
        
        <div class="product-type non-org">
            <a href="/non-origin/catelog"><button class="typeBtn">Non-Original</button></a>
            <img class="img-type" src={{ asset('image\non-original.png') }} alt="non-org">
        </div>

@endsection

@push('after-script')
    
@endpush