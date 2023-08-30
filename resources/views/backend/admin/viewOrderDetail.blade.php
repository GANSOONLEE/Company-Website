@extends('backend.layouts.app')

@section('title', trans('web.view_order'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\admin\viewOrderDetail.css')}}">
@endpush


@push('before-body')
    
@endpush


@push('after-script')
    <script src="{{ asset('js\backend\admin\viewOrderDetail.js') }}"></script>
@endpush


@section('content')

    <div class="section">
        
        <p class="section-title">{{ trans('product.order.view.detail') }}</p>
        
        <div class="order card">
            
            <!-- Order Information -->
            <div class="order-header card-header display-column">
                <div class="display-row order-info">
                    <p id="orderID">{{$order->order_id}}</p>
                    <p>{{$order->order_status}}</p>
                </div>
                <div class="display-row customer-info">
                    <p class="customer-name">{{$order->order_to_user()->username}}</p>
                    <p>{{$order->order_to_user()->company_name}}</p>
                </div>
            </div>
            <!-- Order Items -->
            <div class="order-body">

                <!-- Units -->
                @foreach ($productData as $index => $item)
                    {{-- {{dd($item)}} --}}
                    <div class="order-list display-row" id="item-edit">
                        <p data="index">{{$index+1}}.</p>
                        {{-- <p data="cartID" style="display: none">{{$item[1]->cartID}}</p> --}}
                        <p data="category">{{$item[0]->product_category}}</p>
                        <p data="name">{{json_decode($item[0]->product_name_list)[0]}}</p>
                        <p data="brand">{{$item[1]->brand}}</p>
                        <p data="quantity">{{$item[1]->quantity}}</p>
                        @if(isset($item[1]->own))
                            {{trans('product.own')}} <p data="own">{{$item[1]->own}}</p>
                        @endif
                    </div>
                @endforeach

            </div>

            <!-- I don't know -->
            <div class="order-footer card-footer">
                <div class="button-action-area">
                    {{-- @if($order->order_status === 'On Hold')
                    <button type="button" class="btn btn-secondary" data-order-id="{{$order->order_id}}" id="InProcessButton">
                        {{trans('product.processing')}}
                    </button>
                    @else
                    <button type="button" class="btn btn-secondary" data-order-id="{{$order->order_id}}" id="OnHoldButton" {{$order->order_status == "Completed" ? 'disabled':''}}>
                        {{trans('product.onHold')}}
                    </button>
                    @endif --}}
                    <button type="button" class="btn btn-primary" data-button-action="complete" data-order-id="{{$order->order_id}}" id="CompleteButton" {{$order->order_status == "Completed" ? 'disabled':''}}>
                        @if($order->order_status !== 'Completed' )
                            {{ trans('product.complete') }}
                        @else
                            {{ trans('product.already-complete') }}
                        @endif
                    </button>      
                </div>
            </div>

        </div>
        <p style="font-size: var(--font-small);padding-top: .4rem">{!!trans('product.pending')!!}</p>
        <div class="modal-background" id="backgroundModal" style="display: none">
            <div class="modal" id="editModal" style="display: block">
                <div class="modal-header display-row">
                    <p id="index"></p>
                    <i class="fa-solid fa-xmark" id="backgroundModalButton"></i>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category">{{trans('product.catelog')}}</label>
                        <input required readonly class="form-control" type="text" name="" id="category" value="">
                    </div>
                    <div class="mb-3">
                        <label for="name">{{trans('product.name')}}</label>
                        <input required readonly class="form-control" type="text" name="" id="name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="id">{{trans('product.brand')}}</label>
                        <input required readonly class="form-control" type="text" name="" id="brand" value="">
                    </div>
                    <div class="mb-3">
                        <label for="quantity">{{trans('product.quantity')}}</label>
                        <input required class="form-control" type="text" name="" id="quantity" value="">
                    </div>
                    <div class="mb-3">
                        <label for="own">{{trans('product.own')}}</label>
                        <input class="form-control" type="text" name="" id="own" value="" placeholder="{{trans('product.own')}}">
                    </div>
                    <div class="mb-3" style="display: none">
                        <label for="cartID">{{trans('product.own')}}</label>
                        <input class="form-control" type="text" id="cartID" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="updateProductOwn">
                        {{trans('product.update')}}
                    </button>
                </div>
            </div>
        </div>


    </div>

@endsection