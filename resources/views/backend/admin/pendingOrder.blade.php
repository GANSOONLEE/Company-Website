@extends('backend.layouts.app')

@section('title', trans('web.pending_order'))

@push('after-style')
    <link rel="stylesheet" href={{asset('css\backend\admin\pendingOrder.css')}}>
    <style>
        a{

        }
        .class{

        }
        #id{
            
        }
    </style>
@endpush


@push('before-body')
    
@endpush


@push('after-script')
    <script src={{asset('js\backend\admin\pendingOrder.js')}}></script>
@endpush

@section('content')

    <div class="section">
        <p class="section-title">{{ trans('web.pending_order') }}</p>
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
                    <tr href="/{{$order->order_id}}" id="data-row" data-order-id={{"$order->order_id"}} data-status="{{ $order->order_status }}" class="order">

                        <td data-type="orderID">{{ $order->order_id }}</td> 

                        <td data-type="customerUser">{{ $order->email_address }}</td>

                        <td data-type="orderReceivedDate">{{ $order->order_received_date }}</td>

                        <td data-type="orderReceivedTime">{{ $order->order_received_time }}</td>

                        <td data-type="orderStatus" data-status="{{$order->order_status}}">
                        {{-- <td data-status="Complete"> --}}
                            <span></span>
                            <div style="display: inline-block">{{ $order->order_status }}</div>
                        </td>

                        <td data-type="orderContent" style="display: none">{{ $order->order_content }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
