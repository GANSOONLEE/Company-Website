@extends('backend.layouts.app')


@section('title', __('Dashboard'))


@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\product.css')}}">
@endpush


@push('before-body')
    
@endpush


@push('after-script')
    
@endpush


@section('content')

    <div class="section">
        <p class="section-title">{{trans('product.title')}}</p>
        @include('ui.table')

    </div>


@endsection