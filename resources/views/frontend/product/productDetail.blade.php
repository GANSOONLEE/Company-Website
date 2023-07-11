@extends('frontend.layouts.app')

@section('title', __('Catelog'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\product\productDetail.css')}}">
@endpush


@section('content')

    {{-- <div class="detail">
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
    </div> --}}

    <div class="back-to-prevous-page">
        <a href={{ URL::previous() }}>
            <i class="fa-solid fa-arrow-left"></i>
            <p>Back</p>
        </a>
    </div>

    <div class="detail">
        <div class="detail-header">
            <div class="product-name">
                {{ $product->productName }}
            </div>
            <div class="product-description">

            </div>
        </div>
        <div class="detail-body">
            <div class="detail-product-image-area">
                <div class="product-image-display">
                    <div class="image-display-area">
                        <img src="{{ asset("storage/$product->productCatelog/$product->productModel/$product->productCode/cover.png") }}" alt="" class="product-image-display">
                    </div>
                </div>
                <div class="product-image-selector">
                    <div class="prevous-image" data-image-controller="prevous">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                    <div class="image-selector-area">
                        @foreach ($images as $image)
                            <img src="{{ asset("storage/$image") }}" alt="" class="product-image-hoverable">
                        @endforeach
                    </div>
                    <div class="next-image" data-image-controller="next">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <div class="detail-product-information-area">

                <div class="information-section">
                    <div class="information-section-title">

                    </div>
                    <div class="information-section-content">

                    </div>

                </div>

                <div class="information-section">
                    <div class="information-section-title">

                    </div>
                    <div class="information-section-content">

                    </div>
                </div>

                <div class="action-section">
                    <div class="add-to-cart-area">
                        <div class="quantity-select-area">
                            <button id="addQuantity" class="add-quantity">
                                
                            </button>
                            <div id="displayCurrentQuantity" class="display-current-quantity-box">

                            </div>
                            <button id="removeQuantity" class="remove-quantity">

                            </button>
                        </div>
                        <button class="add-to-cart" id="addToCart">
                            <i></i>
                        </button>
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