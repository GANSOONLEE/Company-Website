
@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\search.css')}}">
    <link rel="stylesheet" href="{{asset('css\frontend\includes\productList.css')}}">

@endpush

@push('before-body')
    @include('ui.searchbar')
@endpush

@section('content')

    @php
        $url = parse_url(request()->url());
        $path = $url['path'];
        $segments = explode('/', $path);
        $parameter = $segments[1] ?? null;

        if ($parameter === 'non-origin') {
            echo "
                <style>
                    .main{
                        background-color: rgba(255, 240, 240, 0.4);
                    }
                    .searchbar {
                        background-image: linear-gradient(45deg, #bf0000, #d24c4c);
                    }    
                </style>
            ";
        } elseif ($parameter === 'origin') {
            echo "
                <style>
                    .main{
                        background-color: rgba(240, 248, 255, 0.4);
                    }
                    .searchbar {
                        background-image: linear-gradient(45deg, hsl(241, 100%, 37%), hsl(241, 60%, 56%));
                    }    
                </style>
            ";
            
        }
    @endphp

    @php
        $model = isset($modelSearch) && $modelSearch->isNotEmpty();
        $name = isset($nameSearch) && $nameSearch->isNotEmpty();
        $code = isset($codeSearch) && $codeSearch->isNotEmpty();
        $brand = isset($brandSearch) && $brandSearch->isNotEmpty();
    @endphp

    <div class="sidebar">

        <input type="checkbox" id="menuBtn" class='menuBtn'>
        <label class="btn" for="menuBtn">
                   
        </label>
        <div class="menu">
            {{-- @if($model)
                <a href="#model" class="model-link">{{ 'Search "' . $searchbarText . '" By Model' }}</a>
            @endif
            @if($name)
                <a href="#name" class="model-link">{{ 'Search "' . $searchbarText . '" By Name' }}</a>
            @endif
            @if($code)
                <a href="#code" class="model-link">{{ 'Search "' . $searchbarText . '" By Code' }}</a>
            @endif
            @if($brand)
                <a href="#brand" class="model-link">{{ 'Search "' . $searchbarText . '" By Brand' }}</a>
            @endif --}}
        </div>
    </div>
    
    <div class="product-list">

        <div class="product-list-header">
            Search product by '{{$searchbarText}}'
        </div>

        <div class="product-list-body">

            <div class="product-list-section">

                @if (count($products) > 0)
                    @foreach ($products as $product)
                        <a href={{ route('frontend.product.detail',['productCode' => $product->productCode]) }}>
                            <div class="product-list-box">
                                <div class="product-list-product-image">
                                    <img class="product-img" src="{{ asset("storage/{$product->productCatelog}/{$product->productModel}/{$product->productCode}/cover.png") }}" alt="">
                                </div>
                                <div class="product-list-product-name">
                                    {{ $product->productCode}}
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif

            </div>

        </div>

        <div class="product-list-footer">

        </div>
    </div>

@endsection

@push('after-script')
    <script>
        function zoomIn(element) {
            var modal = document.querySelector("#myModal");
            var modalImg = document.querySelector("#modalImg");

            // 设置放大的图像
            modalImg.src = element.src;

            // 显示模态框
            modal.style.display = "block";
        }

        // 当用户单击模态框之外的区域时关闭模态框
        window.onclick = function(event) {
            
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
@endpush