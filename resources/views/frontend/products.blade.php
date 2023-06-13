
@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\products.css')}}">
@endpush

@push('before-body')
    @include('ui.searchbar')
@endpush


@section('content')


    

    <div class="sidebar">

        <input type="checkbox" id="menuBtn" class='menuBtn'>
        <label class="btn" for="menuBtn">
                   
        </label>
        <div class="menu">
            @foreach($models as $model)
                @php
                    $modelLink = '/catelog/'.$productCatelog .'/'.$model->modelName;
                    $isActive = request()->is("catelog/$productCatelog/$model->modelName") ? 'active' : '';
                @endphp
    
                <a href="{{ $modelLink }}" class="model-link {{ $isActive }}">{{ ucwords($model->modelName) }}</a>
            @endforeach
        </div>
    </div>

    <div class="products-table">
        @if (count($products) > 0)
            @foreach ($products as $product)
                <div class="product-card">
                    <div class="product-card-header">
                        <img src="{{ $product->productImage }}" alt="照片" class="product-image">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-name">{{ $product->productName }}</h3>
                        <p class="product-code">{{ $product->productCode }}</p>
                    </div>
                    <div class="product-card-footer">
                        {{-- 下單功能 --}}
                    </div>
                </div>
            @endforeach
        @else
            <div class="not-record" style="display: flex; flex-direction: column; row-gap: 5rem; width: 100%">
                <h1>No any Record</h1>
                <img src="{{asset('image\logo.png')}}" style="filter: opacity(0.1); width:20vw; height: auto; align-self: center">
            </div>
        @endif
    </div>

    @php
        $url = parse_url(request()->url());
        $path = $url['path'];
        $segments = explode('/', $path);
        $parameter = $segments[1] ?? null;

        if ($parameter === 'non-origin') {
            echo "
                <style>
                    .searchbar {
                        background-image: linear-gradient(45deg, #bf0000, #d24c4c);
                    }    
                </style>
            ";
        } elseif ($parameter === 'origin') {
            echo "
                <style>
                    .searchbar {
                        background-image: linear-gradient(45deg, hsl(241, 100%, 37%), hsl(241, 60%, 56%));
                    }    
                </style>
            ";
            
        }
    @endphp

@endsection

@push('after-script')
    
@endpush

