@extends('backend.layouts.app')

@section('title', trans('web.edit_product'))

@push('after-style')
    <link rel="stylesheet" href={{asset('css\backend\admin\editProduct.css')}}>
    
@endpush


@push('before-body')
    
@endpush


@push('after-script')
    <script src={{asset('js\backend\admin\editProduct.js')}}></script>
@endpush

@section('content')
    @if (session('alert'))
        <div class="alert alert-{{ session('alert.type') }} alert-dismissible show fade" role="alert" id="alertForm">
            {{ session('alert.message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="section">
        <p class="section-title">{{ trans('product.title.edit') }}</p>
        <div class="button-action-area">
            <p class="instruction">{{trans('product.batch-operation')}}</p>
            <button type="button" class="btn btn-danger" data-button-action="delete">{{ trans('product.delete') }}</button>
            <button type="button" class="btn btn-primary" data-button-action="delist">{{ trans('product.delist') }}</button></button>
            <button type="button" class="btn btn-primary" data-button-action="public">{{ trans('product.public') }}</button></button>
        </div>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th></th>
                    <th>{{trans('table.productID')}}</th>
                    <th>{{trans('table.productNameList')}}</th>
                    <th>{{trans('table.productBrandList')}}</th>
                    <th>{{trans('table.productCatelog')}}</th>
                    <th>{{trans('table.productType')}}</th>
                    <th>{{trans('table.productStatus')}}</th>
                    <th style="display: none">{{trans('table.hidden')}}</th>
                    <th style="display: none">{{trans('table.hidden')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productData as $product)
                    <tr id="data-row" data-product-id={{"$product->productID"}}>
                        <td><input type="checkbox" class="inputCheckbox" id={{"$product->productID"}}></td>

                        <td data-type="productID">{{ $product->productID }}</td>      
                        @if(is_array(json_decode($product->productNameList)))
                            <td data-type="productName">{{json_decode($product->productNameList)[0]}}</td>
                        @else
                            <td data-type="productName" style="color: red">Missing!</td>
                        @endif

                        @if(is_array(json_decode($product->productBrandList)))
                            <td data-type="productBrand">{{json_decode($product->productBrandList)[0]->code}}</td>
                        @else
                            <td data-type="productBrand" style="color: red">Missing!</td>
                        @endif

                        <td data-type="productCatelog">{{ $product->productCatelog }}</td>
                        
                        <td data-type="productType">{{ $product->productType }}</td>
                        
                        <td data-status="{{ $product->productStatus }}">
                            <span></span>
                            <div data-type="productStatus" style="display: inline-block">{{ $product->productStatus }}</div>
                        </td>
                        @if(is_array(json_decode($product->productNameList)))
                            <td data-type="productNameList">{{($product->productNameList)}}</td>
                        @endif

                        @if(is_array(json_decode($product->productBrandList)))
                            <td data-type="productBrandList">{{ ($product->productBrandList)}}</td>
                        @endif
                        </tr>
                @endforeach
            </tbody>
        </table>
        <p class="instruction">{!!trans('product.user-instruction')!!}</p>

    </div>

    @include('backend.admin.includes.editProductForm')

@endsection
