@extends('backend.user.layouts.app')

@section('title', 'Order Detail')

@push('after-style')
    <link rel="stylesheet" rel="preload" href="{{asset('css\backend\user\order\orderDetail.css')}}">
@endpush

@push('before-body')
    
@endpush

@push('after-script')
    <script src={{asset('js\backend\user\order\orderDetail.js')}}></script>
@endpush

@section('content')

    {{-- <p>{{ $orderData->orderStatus }}</p>
    <p>{{ $orderData->created_at }}</p>
    @foreach (json_decode($orderData->orderContent) as $order)
        <p> {{$order->id}} </p>
        <p> {{$order->brand}} </p>
        <p> {{$order->quantity}} </p>
        <br>
    @endforeach
    <br> --}}

    <div class="clipboard display-row">
        <div class="icon"><i class="fa-solid fa-copy"></i></div>
        <p>Copy OrderID</p>
    </div>

    <div class="content">

        <div class="order display-column">

            <!-- Received DateTime, Status -->
            <div class="order-header display-column">
                <p class="title">FROZEN AIR COND SDN. BHD.</p>
                <div class="information display-row">
                    <p>Order ID: <span data-action="clipboard">{{ $orderData->orderID }}</span></p>
                    <p>Time/Date: <span>{{ $orderData->created_at }}</span></p>
                </div>
            </div>
            <p class="order-title">ORDER</p>

            <!-- Order Content -->
            <div class="order-body display-column">

                <!-- Units -->
                <div class="product display-column">
                    <div class="product-header display-row">
                        <p>Category</p>
                        <p>Product Name</p>
                        <p>Product Brand</p>
                        <p>Quantity</p>
                    </div>
                    @foreach ($productData as $index => $product)
                        <div class="product-information display-row">
                            <p> {{$product[0]->productCatelog}} </p>
                            <p> {{json_decode($product[0]->productNameList)[0]}} </p>
                            <p> {{json_decode($orderData->orderContent)[$index]->brand}} </p>
                            <p> {{json_decode($orderData->orderContent)[$index]->quantity}} </p>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- Order Content #TODO Complete infomation -->
            <div class="order-footer">

            </div>
        </div>

    </div>

@endsection