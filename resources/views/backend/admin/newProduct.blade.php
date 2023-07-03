
@extends('backend.layouts.app')


@section('title', __('Products'))


@push('after-style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="{{asset('css\app.css')}}" rel="stylesheet">
    <link href="{{asset('css\backend\products.css')}}" rel="stylesheet">
    <title>{{trans('product.title')}}</title>
@endpush


@push('before-body')
    
@endpush


@push('after-script')
<script>
    // 获取容器和添加按钮的元素
    const inputContainer = document.getElementById('inputContainer');
    const addInputBtn = document.getElementById('addInputBtn');

    // 监听添加按钮的点击事件
    addInputBtn.addEventListener('click', function() {
    // 创建新的输入框元素
    const newInputGroup = document.createElement('div');
    newInputGroup.classList.add('input-group','mb-3');

    const newSecondaryBrand = document.createElement('input');
    newSecondaryBrand.style.textTransform = 'uppercase';
    newSecondaryBrand.classList.add('form-control');
    newSecondaryBrand.classList.add('secondary-input');
    newSecondaryBrand.setAttribute('list', 'secondaryBrandList');
    newSecondaryBrand.id = 'secondaryBrand';
    newSecondaryBrand.placeholder = `{{trans('product.brand')}}`;
    newSecondaryBrand.name = 'secondaryBrand[]';

    const newSecondaryBrandList = document.createElement('datalist');
    newSecondaryBrandList.id = 'secondaryBrandList';
    
    @foreach ($models as $option)
        const newOption{{ $loop->index }} = document.createElement('option');
        newOption{{ $loop->index }}.value = "{{ $option['modelName'] }}";
        newSecondaryBrandList.appendChild(newOption{{ $loop->index }});
    @endforeach

    const newSecondaryModel = document.createElement('input');
    newSecondaryModel.style.textTransform = 'uppercase';
    newSecondaryModel.classList.add('form-control');
    newSecondaryModel.classList.add('secondary-input');
    newSecondaryModel.type = 'text';
    newSecondaryModel.placeholder = `{{trans('product.model')}}`;
    newSecondaryModel.name = 'secondaryModel[]';

    // 将新的输入框添加到容器中
    newInputGroup.appendChild(newSecondaryBrand);
    newInputGroup.appendChild(newSecondaryBrandList);
    newInputGroup.appendChild(newSecondaryModel);
    inputContainer.appendChild(newInputGroup);

    // 监听新输入框的变化事件
    newSecondaryBrand.addEventListener('input', function() {
        // 检查前一个输入框是否有数据
        const previousInput = newInputGroup.previousElementSibling;
        const previousValue = previousInput ? previousInput.querySelector('input[name="secondaryBrand"]').value.trim() : '';

        if (previousValue === '') {
        // 前一个输入框没有数据，隐藏当前输入框
        newInputGroup.style.display = 'none';
        } else {
        // 前一个输入框有数据，显示当前输入框
        newInputGroup.style.display = 'flex';
        }
    });
    });
</script>
@endpush


@section('content')
    
    <div class="content">

        <h1>{{ trans('product.title') }}</h1>
        <hr class="split">

        <form action="/products" method="POST" enctype="multipart/form-data" class="form">
            
            @csrf
            <label class="row-title">{{trans('product.catelog')}}</label>
            <div class="form-row catelog">
                {{-- 物品種類 --}}
                @foreach ($catelogs as $option)
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="productCatelog" id="{{ $option['catelogName'] }}" value="{{ $option['catelogName'] }}">
                        <label class="form-check-label" for="{{ $option['catelogName'] }}">{{ $option['catelogName'] }}</label>
                    </div>
                @endforeach
            </div>

            
            <label class="row-title">{{trans('product.type')}}</label>
            <div class="form-row">
                {{-- 類型 --}}
                <div class="form-check">
                    <input class="form-check-input" id="Non-Origin" type="radio" name="productType" value="Non-Origin" required>
                    <label class="form-check-label" for="Non-Origin">Non-Original</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="Origin" type="radio" name="productType" value="Origin">
                    <label class="form-check-label" for="Origin">Original</label>
                </div>
            </div>


            <label class="row-title">{{trans('product.brand')}} {{trans('product.model')}}</label>
            <div class="form-column" id="inputContainer">
                {{-- 车款和型号 --}}

                {{-- 主要 --}}
                <div class="input-group mb-3" style="display: flex; flex-direction: row;" id="primaryInputGroup">
                    <input required style="text-transform: uppercase;" class="form-control primary-input" list="primaryBrandList" id="primaryBrand" placeholder={{trans('product.brand')}} name="primaryBrand">
                    <datalist id="primaryBrandList">
                        @foreach ($models as $option)
                            <option value="{{ $option['modelName'] }}">
                        @endforeach
                    </datalist>
                    <input required style="text-transform: uppercase;" class="form-control primary-input" type="text" placeholder={{trans('product.model')}} name="primaryModel">
                    <button id="addInputBtn" type="button" class="form-control">添加输入框</button>
                </div>
            </div>

            
            <label class="row-title">{{trans('product.code')}}</label>
            <div class="form-row">
                {{-- 產品編號 --}}
                <div class="productCode">
                    <input name="productCode" id="productCode" class="form-control" type="text" placeholder={{trans('product.code')}} name="primaryModel" autocomplete="off" required>
                </div>
            </div>

            <label class="row-title">{{trans('product.image')}}</label>
            <div class="form-row">
                <div class="container productImage">
                    <input type="file" name="productImage" id="productImage" required accept=".jpg, .png, .jpeg">
                    <label for="productImage" class="label">{{trans('product.image')}}</label>
                </div>
            </div>

            
            {{-- 提交按鈕 --}}
            <button type="submit" class="submitBtn">{{trans('product.submit')}}</button>
        </form> 
    </div>
@endsection
