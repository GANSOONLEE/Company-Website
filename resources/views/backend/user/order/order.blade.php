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
                        <div class="card">
                            <div class="card-header">
                                {{ $order->orderID }}
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

</div>

@endsection