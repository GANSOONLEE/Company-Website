@extends('frontend.layouts.app')

@section('title', __('Type'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\type.css')}}">
@endpush

@section('content')

    <a class="product-type org" href="/origin/catelog">
        <div>
            <img class="img-type" src={{ asset('image\original.png') }} alt="origin">
        </div>
    </a>
        
    <a class="product-type non-org" href="/non-origin/catelog">
        <div>
            <img class="img-type" src={{ asset('image\non-original.png') }} alt="non-org">
        </div>
    </a>

@endsection

@push('after-script')
    
@endpush