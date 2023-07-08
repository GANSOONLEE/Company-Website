@extends('backend.layouts.app')

@section('title', trans('web.edit_product'))

@push('after-style')
    <link rel="stylesheet" href={{asset('css\backend\editProduct.css')}}>
    
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
        
        <p class="section-title">{{trans('product.title.edit')}}</p>
        @include('ui.table')

    </div>


@endsection
