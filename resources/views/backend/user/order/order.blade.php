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

    {{-- #region 
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
                                <!-- <div class="card-footer">

                                </div> -->
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
    {{-- #endregion --}}

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
                <a class="order-status {{ request('status') === 'Received' ? ' active' : '' }}" href="{{ route('backend.user.order', ['status' => 'Received']) }}">
                    <div data-status="Received">
                        Received
                    </div>
                </a>
                
                {{-- In Process --}}
                <a class="order-status {{ request('status') === 'In Process' ? ' active' : '' }}" href="{{ route('backend.user.order', ['status' => 'In Process']) }}">
                    <div data-status="In Process">
                        In Process
                    </div>
                </a>
                
                {{-- Complete --}}
                <a class="order-status {{ request('status') === 'Complete' ? ' active' : '' }}" href="{{ route('backend.user.order', ['status' => 'Complete']) }}">
                    <div data-status="Complete">
                        Complete
                    </div>
                </a>
            </div>

        </div>

        {{-- Display List --}}
        <div class="table-body">

            <div class="order-header display-row">
                <p>Order ID</p>
                <p>Created At</p>
                <p></p>
            </div>

            <div class="order-list display-column">
                @if(count($orderData) > 0 && isset($orderData))
                    @foreach ($orderData as $index => $order)
                    <a class="order {{($index+1)%2==0?'even':'odd'}}" href="{{ route('backend.user.orderDetail', ['orderID' => $order->orderID]) }}">
                        <div class="display-row">
                            <p>{{$order->orderID}}</p>
                            <p>{{$order->created_at}}</p>
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