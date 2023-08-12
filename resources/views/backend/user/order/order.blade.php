@extends('backend.user.layouts.app')

@section('title', 'Order')

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\user\order\order.css')}}">
@endpush

@push('before-body')
    
@endpush

<!-- #TODO write the js to initial table -->
@push('after-script')
    <script src={{asset('js\backend\user\order\order.js')}}></script>
    
@endpush

@section('content')

<div class="content">
    
    
    {{-- @foreach ($orderData as $order)
        <p>{{ $order->orderID }}</p>
        <p>{{ $order->Email }}</p>
        <p>{{ $order->orderStatus }}</p>
        <p>{{ $order->created_at }}</p>
        @foreach (json_decode($order->orderContent) as $order)
            <p> {{$order->id}} </p>
            <p> {{$order->brand}} </p>
            <p> {{$order->quantity}} </p>
            <br>
        @endforeach
        <br>
    @endforeach --}}
    <div class="page-header">
        <div class="page-title">
            <i class="link-icon fa-solid fa-box"></i>
            <p>Your Order</p>
        </div>
    </div>
    <div class="order">

        <div class="order-header">

        </div>

        <!-- Information -->
        <div class="order-body">

            <!-- Units -->
            @foreach ($orderData as $order)
                <div class="order-card">
                    <div class="order-card-header">
                        
                    </div>
                    <div class="order-card-body">

                        <!-- Card -->
                        <div class="card">
                            <div class="card-header">
                                <p class="order-id">{{ $order->orderID }}</p>
                                <p class="update-time"><b>Updated at:</b>{{$order->updated_at}}</p>
                            </div>
                            <div class="card-body" data-status="{{ $order->orderStatus }}">
                                <p>{{ $order->orderStatus }}</p>
                                <div class="card-information">
                                    <p class="received-date">{{ $order->orderReceivedDate }}</p>
                                    <p class="received-time">{{ $order->orderReceivedTime }}</p>
                                </div>
                            </div>
                            {{-- <div class="card-footer">

                            </div> --}}
                        </div>
                        
                    </div>
                    <div class="order-cart-footer">
                        
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Footer -->
        <div class="order-footer">

        </div>
    </div>

    <div class="model-background" id="orderModel">

    <!-- Model -->
    <div class="model">

        <!-- Title -->
        <div class="model-header">
            <p>Order Detail : <span id="orderID">1</span></p>
            <i class="fa-solid fa-xmark" id="closeModalButton"></i>
        </div>

        <!-- Cart -->
        <div class="model-body">
            <div class="order-item-display" id="order-item-list">
                
                <div class="order" data-id="1">
                    <div class="item-info">
                        <p class="item-id" id="ItemID">Perodua Bezza 1.3 2012</p>
                        <p class="item-brand" id="ItemBrand">SWJ-PER 005</p>
                    </div>
                    <div class="item-quantity">
                        <p id="ItemQuantity">
                            12 Qty.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Button -->
        <div class="model-footer">
            <div id="orderStatus"></div>
        </div>
    </div>

</div>

@endsection