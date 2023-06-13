
@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\products.css')}}">
    <link rel="stylesheet" href="{{asset('css\frontend\search.css')}}">
@endpush

@push('before-body')
    @include('ui.searchbar')
@endpush

@section('content')

    @php
        $model = isset($modelSearch) && $modelSearch->isNotEmpty();
        $name = isset($nameSearch) && $nameSearch->isNotEmpty();
        $code = isset($codeSearch) && $codeSearch->isNotEmpty();
    @endphp

    <div class="sidebar">

        <input type="checkbox" id="menuBtn" class='menuBtn'>
        <label class="btn" for="menuBtn">
                   
        </label>
        <div class="menu">
            @if($model)
                <a href="#model" class="model-link">{{ 'Search "' . $searchbarText . '" By Model' }}</a>
            @endif
            @if($name)
                <a href="#model" class="model-link">{{ 'Search "' . $searchbarText . '" By Name' }}</a>
            @endif
            @if($code)
                <a href="#code" class="model-link">{{ 'Search "' . $searchbarText . '" By Code' }}</a>
            @endif
        </div>
    </div>

    <div class="search">

        

        <div class="products-table">
            @if($model)
                <p class="title" id="model">Search Model By '{{$searchbarText}}'</p>
                @foreach ($modelSearch as $model)
                    <div class="product-card">
                        <div class="product-card-header">
                            <img src="{{ $model->productImage }}" alt="照片" class="product-image">
                        </div>
                        <div class="product-card-body">
                            <h3 class="product-name">{{ $model->productName }}</h3>
                            <p class="product-code">{{ $model->productCode }}</p>
                        </div>
                        <div class="product-card-footer">
                            {{-- 下單功能 --}}
                        </div>
                    </div>
                @endforeach
            @endif
            
            @if($name)
                <p class="title" id="name">Search Name By '{{$searchbarText}}'</p>
                @foreach ($nameSearch as $name)
                    <div class="product-card">
                        <div class="product-card-header">
                            <img src="{{ $name->productImage }}" alt="照片" class="product-image">
                        </div>
                        <div class="product-card-body">
                            <h3 class="product-name">{{ $name->productName }}</h3>
                            <p class="product-code">{{ $name->productCode }}</p>
                        </div>
                        <div class="product-card-footer">
                            {{-- 下單功能 --}}
                        </div>
                    </div>
                @endforeach
            @endif
            @if($code)
                <p class="title" id="code">Search Code By '{{$searchbarText}}'</p>
                @foreach ($codeSearch as $code)
                    <div class="product-card">
                        <div class="product-card-header">
                            <img src="{{ $code->productImage }}" alt="照片" class="product-image">
                        </div>
                        <div class="product-card-body">
                            <h3 class="product-name">{{ $code->productName }}</h3>
                            <p class="product-code">{{ $code->productCode }}</p>
                        </div>
                        <div class="product-card-footer">
                            {{-- 下單功能 --}}
                        </div>
                    </div>
                @endforeach
            @endif

            @if(empty($model) && empty($name) && empty($code))
                <div class="alert alert-warning" role="alert">
                    Could not find any records related to '{{ $searchbarText }}'
                </div>
            @endif
        </div>
    </div>


@endsection

@push('after-script')
    
@endpush