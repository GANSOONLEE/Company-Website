
@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\products.css')}}">
    <link rel="stylesheet" href="{{asset('css\frontend\search.css')}}">

    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .modal-content {
            position: sticky;
            top: 12.5%;
            display: block;
            max-width: 80%;
            max-height: 80%;
            margin: auto;
        }
        .section{cursor: pointer;}
    </style>
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
            @if($model)
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
            @endif
        </div>
    </div>

    <div class="search">

        

        <div class="products-table">
            @if($model)
                <p class="title" id="model">Search Model By '{{$searchbarText}}'</p>
                <div class="section">
                    @foreach ($modelSearch as $model)
                        <div class="product-card">
                            <div class="product-card-header">
                                <img src="{{ $model->productImage }}" alt="照片" class="product-image" ondblclick="zoomIn(this)">
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
                </div>
            @endif
            
            @if($name)
                <p class="title" id="name">Search Name By '{{$searchbarText}}'</p>
                <div class="section">
                    @foreach ($nameSearch as $name)
                        <div class="product-card">
                            <div class="product-card-header">
                                <img src="{{ $name->productImage }}" alt="照片" class="product-image" ondblclick="zoomIn(this)">
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
                </div>
            @endif
            @if($code)
                <p class="title" id="code">Search Code By '{{$searchbarText}}'</p>
                <div class="section">
                    @foreach ($codeSearch as $code)
                        <div class="product-card">
                            <div class="product-card-header">
                                <img src="{{ $code->productImage }}" alt="照片" class="product-image" ondblclick="zoomIn(this)">
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
                </div>
            @endif

            @if(empty($model) && empty($name) && empty($code))
                <div class="alert alert-warning" role="alert">
                    Could not find any records related to '{{ $searchbarText }}'
                </div>
            @endif
            @if($brand)
                <p class="title" id="brand">Search Brand By '{{$searchbarText}}'</p>
                <div class="section">
                    @foreach ($brandSearch as $brand)
                        <div class="product-card">
                            <div class="product-card-header">
                                <img src="{{ $brand->productImage }}" alt="照片" class="product-image" ondblclick="zoomIn(this)">
                            </div>
                            <div class="product-card-body">
                                <h3 class="product-name">{{ $brand->productName }}</h3>
                                <p class="product-code">{{ $brand->productCode }}</p>
                            </div>
                            <div class="product-card-footer">
                                {{-- 下單功能 --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(empty($model) && empty($name) && empty($code) && empty($brand))
                <div class="alert alert-warning" role="alert">
                    Could not find any records related to '{{ $searchbarText }}'
                </div>
            @endif
        </div>
    </div>


    <div id="myModal" class="modal">
        <img id="modalImg" class="modal-content" style="width: 60vw">
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