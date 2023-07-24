@extends('backend.user.layouts.app')

@section('title', 'dashboard')

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\product.css')}}">
@endpush


@push('before-body')
    
@endpush


@push('after-script')
    
@endpush


@section('content')

    @include('backend.user.includes.navbar')

@endsection