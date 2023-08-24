@extends('backend.layouts.app')

@section('title', trans('web.view_order'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\admin\viewOrder.css')}}">
@endpush


@push('before-body')
    
@endpush


@push('after-script')
    <script src="{{ asset('js\backend\admin\viewOrder.js') }}"></script>
@endpush


@section('content')

    @if (session('alert'))
        <div class="alert alert-{{ session('alert.type') }} alert-dismissible show fade" role="alert" id="alertForm">
            {{ session('alert.message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="section">
        <p class="section-title">{{ trans('product.order.view') }}</p>
        {{-- <div class="button-action-area">
            <p class="instruction">{{trans('product.batch-operation')}}</p>
            <button type="button" class="btn btn-danger" data-button-action="delete">{{ trans('product.delete') }}</button>
            <button type="button" class="btn btn-primary" data-button-action="delist">{{ trans('product.delist') }}</button></button>
            <button type="button" class="btn btn-primary" data-button-action="public">{{ trans('product.public') }}</button></button>
        </div> --}}
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th data-type="orderID">{{trans('table.orderID')}}</th>
                    <th data-type="customerUser">{{trans('table.userName')}}</th>
                    <th data-type="orderReceivedDate" aria-sort="descending" class="sorting sorting_desc" aria-label="Received Time: activate to sort column descending">{{trans('table.orderReceivedDate')}}</th>
                    <th data-type="orderReceivedTime" aria-sort="descending" class="sorting sorting_desc" aria-label="Received Time: activate to sort column descending">{{trans('table.orderReceivedTime')}}</th>
                    <th data-type="orderStatus">{{trans('table.orderStatus')}}</th>
                    <th style="display: none">{{trans('table.orderContent')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($orderData as $order)
                    <tr href="/{{$order->orderID}}" id="data-row" data-order-id={{"$order->orderID"}} data-status="{{ $order->orderStatus }}" class="order">

                        <td data-type="orderID">{{ $order->orderID }}</td> 

                        <td data-type="customerUser">{{ $order->order_to_user()->username }}</td>

                        <td data-type="orderReceivedDate">{{ $order->orderReceivedDate }}</td>

                        <td data-type="orderReceivedTime">{{ $order->orderReceivedTime }}</td>

                        <td data-type="orderStatus" data-status="{{$order->orderStatus}}">
                        {{-- <td data-status="Complete"> --}}
                            <span></span>
                            <div style="display: inline-block">{{ $order->orderStatus }}</div>
                        </td>

                        <td data-type="orderContent" style="display: none">{{ $order->orderContent }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection