@extends('backend.user.layouts.app')

@section('title', 'Order')

@push('after-style')
    <link rel="stylesheet" rel="preload" href="{{asset('css\backend\user\order\order.css')}}">
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

    <div class="table">

        {{-- Category: New, Received, In Process, Complete --}}
        <div class="table-header">
            
            <div class="order-category">

                {{-- New --}}
                <a class="order-status {{ request('status') === 'New' || !request()->has('status') ? ' active' : '' }}" href="{{ route('backend.user.order', ['status' => 'New']) }}">
                    <div data-status="New">
                        New
                    </div>
                </a>
                
                {{-- Received --}}
                <a class="order-status {{ request('status') === 'Pending' ? ' active' : '' }}" href="{{ route('backend.user.order', ['status' => 'Pending']) }}">
                    <div data-status="Pending">
                        Pending
                    </div>
                </a>
                
                {{-- In Process --}}
                <a class="order-status {{ request('status') === 'Processing' ? ' active' : '' }}" href="{{ route('backend.user.order', ['status' => 'Processing']) }}">
                    <div data-status="Processing">
                        Processing
                    </div>
                </a>
                
                {{-- Complete --}}
                <a class="order-status {{ request('status') === 'Completed' ? ' active' : '' }}" href="{{ route('backend.user.order', ['status' => 'Completed']) }}">
                    <div data-status="Completed">
                        Completed
                    </div>
                </a>
            </div>

        </div>

        {{-- Display List --}}
        <div class="table-body">

            <div class="order-header display-row">
                <p>Order ID</p>
                <p>Created At</p>
                <p>Item Quantity</p>
            </div>

            <div class="order-list display-column">
                @if(count($orderData) > 0 && isset($orderData))
                    @foreach ($orderData as $index => $order)
                    <a class="order {{($index+1)%2==0?'even':'odd'}}" href="{{ route('backend.user.orderDetail', ['orderID' => $order->order_id]) }}">
                        <div class="display-row">
                            <p>{{$order->order_id}}</p>
                            <p>{{$order->created_at}}</p>
                            <p>{{count(json_decode($order->order_content))}}</p>
                        </div>
                    </a>
                    @endforeach
                @else
                    <div class="no-data display-column">
                        <object data="{{asset('images\Shipping Bag.svg')}}" type="image/svg+xml"></object>
                        <p>There are not orders yet.</p>
                    </div>
                @endif
            </div>

        </div>

        {{-- Pagination --}}
        <div class="table-footer">

        </div>
    </div>

@endsection