@extends('backend.user.layouts.app')

@section('title', 'Cart')

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\product.css')}}">
@endpush


@push('before-body')
    
@endpush

<!-- 
    #TODO write the js to initial table
-->
@push('after-script')
    <script src={{asset('js\backend\user\cart\cart.js')}}></script>
@endpush

<!-- #TODO fill in the information inside the table -->

@section('content')
    
@endsection