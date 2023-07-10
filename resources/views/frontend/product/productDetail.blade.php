@extends('frontend.layouts.app')

@section('title', __('Catelog'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\product\productDetail.css')}}">
@endpush


@section('content')

    <div class="detail">
        <div class="detail-header">
            <a href={{ URL::previous() }}>
                <i class="fa-solid fa-arrow-left"></i>
                <p class="back">Back</p>
            </a>
        </div>
        <div class="detail-body">
            <div class="product-image-area">
                <div class="product-primary-image">
                    <img src="{{ asset("storage/$product->productCatelog/$product->productModel/$product->productCode/cover.png") }}" alt="" class="product-image-display">
                </div>
                <div class="product-another-image">
                    <img src="{{ asset("storage/$product->productCatelog/$product->productModel/$product->productCode/cover.png") }}" alt="" class="product-image-hoverable hover">
                    @foreach ($images as $image)
                        <img src="{{ asset("storage/$image") }}" alt="" class="product-image-hoverable">
                    @endforeach
                </div>
            </div>
            <div class="product-information">
                <div class="product-name">
                    {{ $product->productName }}
                </div>
                <div class="product-car-model-list">
                    <p class="product-car-model-title">Available models:</p>
                    <label class="product-car-model disable-order-function" for={{$product->productModel}}>
                        <input type="radio" id={{$product->productModel}} name='model' value={{$product->productModel}}>
                        <p class="car-model">{{$product->productModel}} {{$product->productBrand}}</p>
                    </label>
                    @if($product->productSubname)
                        @php
                            $models = json_decode($product->productSubname)
                        @endphp
                        @foreach ($models as $model)
                            <label class="product-car-model disable-order-function">
                                <input type="radio" name='model' value={{$model->brand}}>
                                <p class="car-model">{{$model->brand}} {{$model->model}}</p>
                            </label>
                        @endforeach
                    @endif
                </div>
                <div class="button-area">
                    <div class="product-quantity">

                    </div>
                    <div class="add-to-cart">

                    </div>
                </div>
            </div>
        </div>
        <div class="detail-footer">

        </div>
    </div>


@endsection

@push('after-script')
    <script src={{ asset('js\frontend\product\productDetail.js') }}></script>
@endpush