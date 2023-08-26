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
        {{-- <div class="button-action-area">
            <p class="instruction">{{trans('product.batch-operation')}}</p>
            <button type="button" class="btn btn-danger" data-button-action="delete">{{ trans('product.delete') }}</button>
            <button type="button" class="btn btn-primary" data-button-action="delist">{{ trans('product.delist') }}</button></button>
            <button type="button" class="btn btn-primary" data-button-action="public">{{ trans('product.public') }}</button></button>
        </div> --}}
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
                    <tr id="data-row" data-product-id={{"$product->product_id"}}>
                        <td><input type="checkbox" class="inputCheckbox" id={{"$product->product_id"}}></td>

                        <td data-type="productID">{{ $product->product_id }}</td>      

                        <td data-type="productName">{{json_decode($product->product_name_list)[0]}}</td>

                        <td data-type="productBrand">{{json_decode($product->product_brand_list)[0]->code}}</td>

                        <td data-type="productCatelog">{{ $product->product_category }}</td>
                        
                        <td data-type="productType">{{ $product->product_type }}</td>
                        
                        <td data-status="{{ $product->product_status }}">
                            <span></span>
                            <div data-type="productStatus" style="display: inline-block">{{ $product->product_status }}</div>
                        </td>
                        @if(is_array(json_decode($product->product_name_list)))
                            <td style="display: none" data-type="productNameList">{{($product->product_name_list)}}</td>
                        @endif

                        @if(is_array(json_decode($product->product_brand_list)))
                            <td style="display: none" data-type="productBrandList">{{ ($product->product_brand_list)}}</td>
                        @endif
                        </tr>
                @endforeach
            </tbody>
        </table>
        <p class="instruction">{!!trans('product.user-instruction')!!}</p>

    </div>

    @include('backend.admin.includes.editProductForm')

@endsection
