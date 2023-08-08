@extends('backend.user.layouts.app')

@section('title', 'Cart')

@push('after-style')
    
@endpush

@push('before-body')
    
@endpush

<!-- 
    #TODO write the js to initial table
-->
@push('after-script')
    <script src={{asset('js\backend\user\cart\cart.js')}}></script>
    <link rel="stylesheet" href="{{asset('css\backend\user\cart\cart.css')}}">
@endpush

<!-- #TODO fill in the information inside the table -->

@section('content')
    <div class="cart-container">

        <!-- page title and description -->
        <div class="cart-header">
            <div class="page-title">Order</div>
        </div>

        <!-- product cards -->
        <div class="cart-body">

            <!-- cards list container -->
            <div class="cards-container">

                <!-- title -->
                <div class="cards-header">

                </div>

                <!-- list of card -->
                <div class="cards-body">

                    <!-- card object -->
                    @foreach ($carts as $cart) 
                        <div class="product-card" data-cart="{{$cart->ID}}" data-product-id="{{$cart->productID}}" data-quantity="{{$cart->quantity}}" data-brand="{{$cart->productBrand}}">
                            <div class="product-card-header">
                                <a href={{route('frontend.product.detail',['productCode' => $cart->productID])}}>
                                    <div class="hover">
                                        View Product
                                    </div>
                                    <img class="product-card-image" src="{{ asset("storage/{$cart->cart_to_product()['productCatelog']}/{$cart->productID}/cover.png") }}" alt="product-image">
                                </a>
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $cart->productBrand }}</p>
                                <p class="product-category">{{ $cart->cart_to_product()['productCatelog'] }}</p>
                            </div>
                            <div class="product-card-footer">
                                
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- #TODO pagination -->
                <div class="cards-footer">

                </div>
            </div>
        </div>

        <!-- optional -->
        <div class="cart-footer">

        </div>
    </div>
@endsection