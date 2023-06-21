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
        @php
            $alertType = session()->get('alertType');
            $message = session()->get('message');
        @endphp

        @if(isset($alertType, $message))
            @include('ui.alert')
        @endif
        
        <p class="section-title">{{trans('product.title')}}</p>
        @include('ui.table')

    </div>


@endsection
