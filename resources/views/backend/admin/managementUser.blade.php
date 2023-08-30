@extends('backend.layouts.app')

@section('title', trans('web.user_management'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\backend\admin\managementUser.css')}}">
@endpush


@push('before-body')
    
@endpush


@push('after-script')
    <script src="{{asset('js\backend\admin\managementUser.js')}}"></script>
@endpush


@section('content')

    <div class="section">
        <p class="section-title">{{ trans('web.user_management') }}</p>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>{{trans('table.ID')}}</th>
                    <th>{{trans('table.userID')}}</th>
                    <th>{{trans('table.operationType')}}</th>
                    <th>{{trans('table.created_at')}}</th>
                    <th>{{trans('table.restore')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($operationData as $operation)
                    <tr id="data-row">
                        <td data-type="ID">{{$operation->operation_id}}</td>
                        
                        <td data-type="userID">{{ $operation->operation_to_user()->username }}</td>      

                        @if($operation->operation_type==='create product')
                            <td data-type="operation_type">
                                {{trans('table.create-product')}} <b>{{$operation->operation_data['product']}}</b>
                            </td>
                        @elseif($operation->operation_type==='update product')
                            <td data-type="operation_type">
                                {{trans('table.update-product')}} <b>{{$operation->operation_data['product']}}</b>
                            </td>
                        @else
                            <td data-type="operation_type">
                                {{trans('table.delete-product')}} <b>{{$operation->operation_data['product']}}</b>
                            </td>    
                        @endif

                        <td data-type="created_at">{{$operation->created_at}}</td>
                        
                        @if(stripos($operation->operation_type, 'Delete Product') !== false)
                            <td data-type="button">
                                <button class="restoreButton" type="button" data-operation-id="{{$operation->operation_id}}" id="{{$operation->operation_data['product']}}">{{trans('table.restore')}}</button>
                            </td>
                        @else
                            <td data-type="button"></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection