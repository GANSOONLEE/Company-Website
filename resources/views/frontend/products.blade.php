<!DOCTYPE html>




@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\products.css')}}">
@endpush

@push('before-body')
    @include('ui.searchbar')
@endpush

@section('content')

    <div class="sidebar">
        @foreach($models as $model)
            <a href="/{{$productCatelog}}/{{$model->modelName}}" class="model">{{ $model->modelName }}</a>
        @endforeach
    </div>

    <div class="products-table">
        @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ $product->productImage }}" alt="照片" class="product-image">
                <h3 class="product-name">{{ $product->productName }}</h3>
                <p class="product-code">{{ $product->productCode }}</p>
            </div>
        @endforeach
    </div>


@endsection

@push('after-script')
    
@endpush