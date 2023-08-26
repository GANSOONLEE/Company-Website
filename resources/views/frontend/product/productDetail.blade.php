@extends('frontend.layouts.app')

@section('title', __('Product Detail'))

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
            <input style="display: none" type="text" name="productCategory" id="" value="{{ $product->product_category }}">
        </div>
        <div class="detail-body">
            <div class="detail-product-image-area">
                <div class="product-image-display">
                    <div class="image-display-area">
                        <img src="{{ asset("storage/{$product->product_category}/{$product->product_id}/cover.png") }}" alt="image-product" class="product-image-display">
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
            <div class="detail-product-information-area display-column">

                <!-- Product Name -->
                <div class="detail-product-information-subarea">
                    <!-- Product Name -->
                    <div class="information-section">
                        <div class="information-section-content">
                            <div class="product-name">
                                {{ json_decode($product->product_name_list)[0] }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car Model | Brand -->
                <div class="detail-product-information-subarea display-row">
                    
                    <!-- Car Model -->
                    <div class="information-section car-model">
                        <div class="information-section-content display-column">
                            <div class="section-title">
                                <p class="">Car Model</p>
                            </div>
                            @foreach ((json_decode($product->product_name_list)) as $name)
                                <p>{{ $name }}</p>
                            @endforeach
                        </div>
                    </div>

                    <!-- Brand -->
                    <div class="information-section display-column brand-list-box">
                        
                        <!-- brand list -->
                        <div class="information-section-content display-column  brand-list-container">
                            <div class="section-title">
                                <p class="">Brand</p>
                            </div>
                            <div class="brand-list">
                                @foreach ((json_decode($product->product_brand_list)) as $brand)
                                    <input type="radio" name='brand' value="{{$brand->code}}" id="{{$brand->code}}">
                                    <label class="product-brand" for="{{$brand->code}}">
                                        <p>{{$brand->code}}</p>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- cart -->
                        <div class="information-section display-column">
                            <div class="action-section display-column">
                                <div class="action-title">
                                    Quantity
                                </div>
                                <div class="add-to-cart-area">
                                    <div class="quantity-select-area">
                                        <button id="removeQuantity" class="remove-quantity quantityButton">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                        <div id="displayCurrentQuantity" class="display-current-quantity-box">
                                            <p id="currentQuantity">1</p>
                                        </div>
                                        <button id="addQuantity" class="add-quantity quantityButton">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                    <button class="add-to-cart" id="addToCart">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                {{-- <div class="information-section">
                    <div class="information-section-title">

                    </div>
                    <div class="information-section-content">
                        <div class="product-name">
                            {{ $product->productName }}
                        </div>
                    </div>

                </div>

                <div class="information-section">
                    <div class="information-section-title">
                        
                    </div>
                    <div class="information-section-content">
                        <div class="product-description-content">
                            Description
                        </div>
                    </div>
                </div>

                <div class="information-section">
                    <div class="information-section-title">
                        Available Brand:
                    </div>
                    <div class="information-section-content">
                        @if($product->productBrandList)
                            @foreach ((json_decode($product->productBrandList)) as $brand)
                                <input type="radio" name='brand' value="{{$brand->code}}" id="{{$brand->code}}">
                                <label class="product-brand disable-order-function" for="{{$brand->code}}">
                                    <p>{{$brand->code}}</p>
                                </label>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="action-section adisable-funciton">
                    <div class="action-title">
                        Quantity
                    </div>
                    <div class="add-to-cart-area">
                        <div class="quantity-select-area">
                            <button id="removeQuantity" class="remove-quantity quantityButton">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <div id="displayCurrentQuantity" class="display-current-quantity-box">
                                <p id="currentQuantity">1</p>
                            </div>
                            <button id="addQuantity" class="add-quantity quantityButton">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <button class="add-to-cart" id="addToCart">
                            <i class="fa-solid fa-cart-shopping" style="color: #ee3211;"></i>
                            Add to cart
                        </button>
                    </div>
                </div> --}}

            </div>
        </div>
        <div class="detail-footer">

        </div>
    </div>

    <div class="user-action">
        @auth
            <a href={{ route('backend.user.cart') }} target="_new">
                <div class="notification">{{ $cart }}</div>
                <div class="view-cart user-action-button">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </a>
        @endauth
        <a href="https://www.wasap.my/60172430100" target="_new">
            <div class="whatapps user-action-button">
                <i class="fa-brands fa-whatsapp"></i>
            </div>
        </a>
    </div>
    

@endsection

@push('after-script')
    <script src={{ asset('js\frontend\product\productDetail.js') }}></script>
@endpush