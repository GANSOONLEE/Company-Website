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
            <div class="order-header card-header display-row">
                <p>{{$order->orderID}}</p>
                <p>{{$order->orderStatus}}</p>
            </div>

            <!-- Order Items -->
            <div class="order-body">
                
                <!-- Units -->
                @foreach ($productData as $index => $item)
                    <div class="order-list display-row" id="item-edit">
                        <p data="index">{{$index+1}}.</p>
                        <p data="id" style="display: none">{{$item[0]->productID}}</p>
                        <p data="category">{{$item[0]->productCatelog}}</p>
                        <p data="name">{{json_decode($item[0]->productNameList)[0]}}</p>
                        <p data="brand">{{$item[1]->brand}}</p>
                        <p data="quantity">{{$item[1]->quantity}}</p>
                    </div>
                @endforeach

            </div>

            <!-- I don't know -->
            <div class="order-footer card-footer">
                <div class="button-action-area">
                    <button type="button" class="btn btn-primary" data-button-action="complete" data-order-id={{$order->orderID}} id="CompleteButton" {{$order->orderStatus == "Complete" ? 'disabled':''}}>
                        @if($order->orderStatus === 'In Process')
                            {{ trans('product.complete') }}
                        @else
                            {{ trans('product.already-complete') }}
                        @endif
                    </button>      
                </div>
            </div>

        </div>

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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">
                        {{trans('product.submit')}}
                    </button>
                </div>
            </div>
        </div>


    </div>

@endsection