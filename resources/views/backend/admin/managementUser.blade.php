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
                    <th>{{trans('table.userID')}}</th>
                    <th>{{trans('table.ID')}}</th>
                    <th>{{trans('table.operationType')}}</th>
                    <th>{{trans('table.created_at')}}</th>
                    <th>{{trans('table.restore')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($operationData as $operation)
                    <tr id="data-row">
                        <td data-type="userID">{{ $operation->userID }}</td>      

                        <td data-type="ID">{{$operation->ID}}</td>

                        
                        @if($operation->operationType=='Create Product')
                            <td data-type="operationType">{{trans('table.create-product')}}</td>
                        @elseif($operation->operationType=='Update Product')
                            <td data-type="operationType">{{trans('table.update-product')}}</td>
                        @else
                            <td data-type="operationType">{{trans('table.delete-product')}}</td>    
                        @endif

                        <td data-type="created_at">{{$operation->created_at}}</td>
                        
                        @if(stripos($operation->operationType, 'Delete Product') !== false)
                            <td data-type="button">
                                <button class="restoreButton" type="button" data-operation-id={{$operation->operationID}} id={{$operation->ID}}>{{trans('table.restore')}}</button>
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