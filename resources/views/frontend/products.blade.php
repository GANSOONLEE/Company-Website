
@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\products.css')}}">
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
            width: 60vw
        }
        .section{cursor: pointer;}
        @media only screen and (max-width:972px){
            .modal{
                width: 100vw;
            }
            .modal-content {
                max-width: 100vw;
                width: 100vw;
                top: 25%;
                margin: 0;
                display: block;
            }
        }
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

    <div class="sidebar">
        <input type="checkbox" id="menuBtn" class='menuBtn'>
        <label class="btn" for="menuBtn">
                   
        </label>
        <div class="menu">
            @foreach($models as $model)
                @php
                    $isActive = request()->is("catelog/$productCatelog/$model->modelName") ? 'active' : '';
                @endphp
    
                <a href="/{{ $productType }}/catelog/{{ $productCatelog }}/{{ $model->modelName }}" class="model-link {{ $isActive }}">{{ ucwords($model->modelName) }}</a>
            @endforeach
        </div>
    </div>

    <div class="products-table">
        @if (count($products) > 0)
            @foreach ($products as $product)
                <div class="product-card">
                    <div class="product-card-header">
                        <img src="{{ $product->productImage }}" alt="照片" class="product-image" ondblclick="zoomIn(this)">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-name">{{ $product->productName }}</h3>
                        <p class="product-code">{{ $product->productCode }}</p>
                    </div>
                    <div class="product-card-footer">
                        
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

    <div id="myModal" class="modal">
        <img id="modalImg" class="modal-content">
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

