@extends('backend.user.layouts.app')

@section('title', 'Cart')

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\user\cart\cart.css')}}">
@endpush

@push('before-body')
    
@endpush

<!-- #TODO write the js to initial table -->
@push('after-script')
    <script src={{asset('js\backend\user\cart\cart.js')}}></script>
    
@endpush

<!-- #TODO fill in the information inside the table -->

@section('content')
    {{-- <div class="cart-container">
        <!-- page title and description -->
        <div class="cart-header">
            <div class="page-title">Order</div>
            <button class="button-create-order" id="checkOrder">
                <div class="center">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="center">
                    <p>Create Order</p>
                </div>
            </button>
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
                        <label for="{{$cart->ID}}">
                            <input type="checkbox" name="cartToOrder[]" id="{{$cart->ID}}">
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
                        </label>
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
    </div> --}}

    {{-- <div class="checkout-form">
        
        <!-- Heading, Title -->
        <div class="checkout-form-header">
            
        </div>

        <!-- Order Content -->
        <div class="checkout-form-body">

            <!-- Unit of product list -->
            <div class="product">
                <div class="product-image">

                </div>
                <div class="product-infomation">

                </div>
                <div class="product-action">
                    
                </div>
            </div>

        </div>

        <!-- Action Button -->
        <div class="checkout-form-footer">

        </div>
    </div> --}}

<div class="content">

    <!-- page title and description -->
    <div class="page-header">
        <div class="page-title">
            <i class="fa-solid fa-cart-shopping"></i>
            <p>Your Cart</p>
        </div>
        <button class="button-create-order" id="checkOrder">
            <div class="center">
                <i class="fa-solid fa-plus"></i>
            </div>
            <div class="center">
                <p>Create Order</p>
            </div>
        </button>
    </div>
    <table id="myTable">
        <thead>
            <tr>
                <th></th>
                <th>Category</th>
                <th>Car Model</th>
                <th>Product Code</th>
                <th>Quantity</th>
                <th data-header="Checkbox">
                    <input class="selectAllCheckbox" id="selectAll" type="checkbox" name="" style="display: block">
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $index => $cart)
                <tr class="product-card" data-product-id="{{ $cart->productID }}" data-quantity="{{ $cart->quantity }}" data-brand="{{ $cart->productBrand }}" data-cart="{{ $cart->ID }}">
                    <td data-column="Index">{{ $index+1 }}</td>
                    <td data-column="Category">{{ $cart->cart_to_product()['productCatelog'] }}</td>
                    <td data-column="Name">{{ json_decode($cart->cart_to_product()['productNameList'])[0] }}</td>
                    <td data-column="Brand">{{ $cart->productBrand}}</td>
                    <td data-column="Quantity">

                    </td>
                    <td data-column="Checkbox">
                        <input class="checkbox" type="checkbox" name="productOrder[]" data-cart-id="{{ $cart->ID }}" data-brand="{{ $cart->productBrand }}" data-id="{{ $cart->productID }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @php
        $email = Auth::user()->Email;
    @endphp
    <p id="email" style="display: none">{{$email}}</p>
</div>

{{-- <div class="model-background">

    <!-- Model -->
    <form action="{{route('api.create-order')}}" method="post">
    <div class="model" id="productModel">

        <!-- Title -->
        <div class="model-header">
            <p>Comfirm Order</p>
            <i class="fa-solid fa-xmark" id="closeModelButton"></i>
        </div>

        <!-- Cart -->
        <div class="model-body">
            <div class="cart-display" id="confirm-order-cart-list">
                
                @foreach($carts as $cart)
                <div class="cart" data-id="1">
                    <div class="cart-info">
                        <p class="product-name">Perodua Bezza 1.3 2012</p>
                        <p class="product-brand">SWJ-PER 005</p>
                    </div>
                    <div class="cart-quantity">
                        <p id="cart-quantity">
                            12 Qty.
                        </p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        <!-- Button -->
        <div class="model-footer">

        </div>
    </div>
    </form>
</div> --}}

@endsection