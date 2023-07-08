@extends('frontend.layouts.app')

@section('title', __('Catelog'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\product\productDetail.css')}}">
@endpush


@section('content')

    <div class="detail">
        <div class="detail-header"></div>
        <div class="detail-body"></div>
        <div class="detail-footer"></div>
    </div>


@endsection

@push('after-script')
    
@endpush