@extends('backend.user.layouts.app')

@section('title', 'Order')

@push('after-style')
    <link rel="stylesheet" rel="preload" href="{{asset('css\backend\user\order\orderDetail.css')}}">
@endpush

@push('before-body')
    
@endpush

@push('after-script')
    <script src={{asset('js\backend\user\order\orderDetail.js')}}></script>
@endpush

@section('content')

    <div class="content">

    </div>

@endsection