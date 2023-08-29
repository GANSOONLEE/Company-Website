@extends('backend.user.layouts.app')

@section('title', 'Cart')

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\user\cart\cart.css')}}">
    <link rel="stylesheet" href="{{asset('css\backend\user\cart\cartForm.css')}}">
@endpush

@push('before-body')
    
@endpush

<!-- #TODO write the js to initial table -->
@push('after-script')
    <script src={{asset('js\backend\user\cart\cart.js')}}></script>
    
@endpush

<!-- #TODO fill in the information inside the table -->

@section('content')

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
                <p>Generating Order</p>
            </div>
        </button>
    </div>
    <table id="myTable">
        <thead>
            <tr>
                {{-- <th></th> --}}
                <th>Category</th>
                <th>Product Id</th>
                <th>Product Brand Code</th>
                <th>Quantity</th>
                <th data-header="Checkbox">
                    <input class="selectAllCheckbox" id="selectAll" type="checkbox" name="" style="display: block">
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            {{-- {{dd($cart)}} --}}
                @foreach ($cart->cart_content as $index => $content)
                    <tr class="product-card" data-cart-id="{{ $cart->cart_ID }}"  data-id="{{ $content['product_code'] }}" data-quantity="{{ $content['cart_content'][0]['quantity'] }}" data-brand="{{ $content['cart_content'][0]['brand_code'] }}">
                        {{-- <td data-column="Index">{{ $index+1 }}</td> --}}
                        <td data-column="Category">{{ $content['product_category'] }}</td>
                        <td data-column="Name">{{ json_decode($cart->cart_to_product('product_id', $content['product_code'])->product_name_list)[0] }}</td>
                        <td data-column="Brand">{{ $content['cart_content'][0]['brand_code'] }}</td>
                        <td data-column="Quantity"></td>
                        <td data-column="Checkbox">
                            <input class="checkbox" type="checkbox" name="productOrder[]" data-cart-id="{{ $cart->cart_ID }}" data-brand="{{ $cart->productBrand }}" data-id="{{ $cart->productID }}">
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <p id="email" style="display: none">{{auth()->user()->email_address}}</p>
    @if(isset($cartData))
        @include('backend.user.cart.cartForm')
    @endif
</div>

@endsection