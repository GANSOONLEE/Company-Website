@extends('backend.layouts.app')

@section('title', trans('web.user_management'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\admin\managementUser.css')}}">
@endpush


@push('before-body')
    
@endpush


@push('after-script')
    <link rel="stylesheet" href="{{asset('js\backend\managementUser.js')}}">
@endpush


@section('content')

    <div class="section">
        <p class="section-title">{{ trans('web.user_management') }}</p>
    </div>

@endsection