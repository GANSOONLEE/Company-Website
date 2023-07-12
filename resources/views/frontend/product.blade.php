
@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\product.css')}}">
    <style>
        
    </style>
@endpush

@push('before-body')
    @include('ui.searchbar')
@endpush


@section('content')
    {{-- @php
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
    @endphp --}}

    @include('includes.filter')

    {{-- <div class="products-table">
        @if (count($products) > 0)
            @foreach ($products as $product)
                <div class="product-card">
                    <div class="product-card-header">
                        <img src="{{ $product->productImage }}" alt="照片" class="product-image" ondblclick="zoomIn(this)">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-name">{{ $product->productName }}</h3>
                        @php
                            $subnames = json_decode($product->productSubname, true);
                        @endphp
                        @if (is_array($subnames))
                            @foreach ($subnames as $subname)
                                <h5 class="product-subname">{{ $subname['brand'] }} {{ $subname['model'] }}</h5>
                            @endforeach
                        @else
                            <h5 class="product-subname">{{ $product->productSubname }}</h5>
                        @endif
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
    </div> --}}
    @include('frontend.includes.productList')

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
