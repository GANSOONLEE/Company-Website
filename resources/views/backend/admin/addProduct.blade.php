
@extends('backend.layouts.app')

@section('title', trans('web.new_product'))

@push('after-style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href={{ asset('css/backend/admin/newProduct.css') }} rel="stylesheet">
@endpush


@push('before-body')
    
@endpush


@push('after-script')
    
    <script src={{ asset('js\backend\admin\upload.js') }}></script>

@endpush


@section('content')
    <div class="content">
        <div class="content-header">
            <h1 class="content-title">
                <i class="fa-solid fa-cube"></i>
                {{ trans('product.title.create') }}
            </h1>
        </div>
        <div class="content-body">
            <form action={{ route('backend.admin.createdProduct') }} method="POST" enctype="multipart/form-data" class="form">
                @csrf
                @include('backend.admin.includes.addProductForm')
            </form>
        </div>
        <div class="content-footer">

        </div>
         
    </div>
@endsection
