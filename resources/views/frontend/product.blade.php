
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

    @include('includes.filter')

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

