
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
{{-- 

    
    <label class="row-title">{{trans('product.catelog')}}</label>
    <div class="form-row catelog">
        {{-- 物品種類 --}}
        {{-- @foreach ($catelogs as $option)
            <div class="form-check">
                <input required class="form-check-input" type="radio" name="productCatelog" id="{{ $option['catelogName'] }}" value="{{ $option['catelogName'] }}">
                <label class="form-check-label" for="{{ $option['catelogName'] }}">{{ $option['catelogName'] }}</label>
            </div>
        @endforeach
    </div>

    
    <label class="row-title">{{trans('product.type')}}</label>
    <div class="form-row">
        {{-- 類型 --}}
        {{-- <div class="form-check">
            <input class="form-check-input" id="Non-Origin" type="radio" name="productType" value="Non-Origin" required>
            <label class="form-check-label" for="Non-Origin">Non-Original</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" id="Origin" type="radio" name="productType" value="Origin">
            <label class="form-check-label" for="Origin">Original</label>
        </div>
    </div>


    <label class="row-title">{{trans('product.brand')}} {{trans('product.model')}}</label>
    <div class="form-column" id="inputContainer"> --}}
        {{-- 车款和型号 --}}

        {{-- 主要 --}}
        {{-- <div class="input-group mb-3" style="display: flex; flex-direction: row;" id="primaryInputGroup">
            <input required style="text-transform: uppercase;" class="form-control primary-input" list="primaryBrandList" id="primaryBrand" placeholder={{trans('product.brand')}} name="primaryModel">
            <datalist id="primaryBrandList">
                @foreach ($models as $option)
                    <option value="{{ $option['modelName'] }}">
                @endforeach
            </datalist>
            <input required style="text-transform: uppercase;" class="form-control primary-input" type="text" placeholder={{trans('product.model')}} name="primaryBrand">
            <button id="addInputBtn" type="button" class="form-control">添加输入框</button>
        </div>
    </div>

    
    <label class="row-title">{{trans('product.code')}}</label>
    <div class="form-row"> --}}
        {{-- 產品編號 --}}
        {{-- <div class="productCode">
            <input name="productCode" id="productCode" class="form-control" type="text" placeholder={{trans('product.code')}} name="primaryModel" autocomplete="off" required>
        </div>
    </div>

    <label class="row-title">{{trans('product.image')}}</label>
    <div class="form-row">
        <div class="container productImage">
            <input type="file" name="productImage" id="productImage" required accept=".jpg, .png, .jpeg">
        </div>
    </div>

     --}}
    {{-- 提交按鈕 --}}
    {{-- <button type="submit" class="submitBtn">{{trans('product.submit')}}</button> --}}

    {{-- @extends('includes.alert')

    @section('alert-type', 'info')
    @section('alert-message', 'test') --}}

    <form action={{ route('backend.admin.createdProduct') }} method="POST" enctype="multipart/form-data" class="form">
        @csrf

        {{-- Upload Image --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text">
                    {{ trans('product.image') }}
                </p>
            </div>
            <div class="form-row-body">
                <div class="form-row-image" data-drop-id="image">
                    <div id="drop" class="drop-box" onclick="upload()">
                        <p class="drop-text">
                            <p class="note">{{ trans('product.addImage') }}</p><br>
                            <span class="count">(0/10)</span>
                            <input type="file" multiple accept=".png, .jpeg, .jpg, .gif" id="uploadButton">
                            <input type="hidden" id="imgUpload" name="images[]"></a>
                        </p>
                    </div>
                    <div class="drop-image-list" id="dropImageList">
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Code --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text">
                    {{ trans('product.code') }}
                </p>
            </div>
            <div class="form-row-body">
                <input type="text" class="form-control" name="productCode" id="productCode" placeholder={{ trans('product.code') }} required>
            </div>
        </div>

        {{-- Product Catelog --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text">
                    {{ trans('product.catelog') }}
                </p>
            </div>
            <div class="form-row-body">
                <div class="form-row-body-radio">
                    @foreach ($catelogs as $option)
                        <label for="{{ $option['catelogName'] }}">
                            <input required class="form-check-input" type="radio" name="productCatelog" id="{{ $option['catelogName'] }}" value="{{ $option['catelogName'] }}">
                            <div required class="form-radio">{{ $option['catelogName'] }}</div>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Product Type --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text">
                    {{ trans('product.type') }}
                </p>
            </div>
            <div class="form-row-body">
                <div class="form-row-body-radio">
                    <label class="form-check-label" for="Origin">
                        <input class="form-check-input" id="Origin" type="radio" name="productType" value="Origin">
                        <div required class="form-radio">Original</div>
                    </label>
                        
                    <label class="form-check-label" for="Non-Origin">
                        <input class="form-check-input" id="Non-Origin" type="radio" name="productType" value="Non-Origin">
                        <div required class="form-radio">Non-Original</div>
                    </label>
                </div>
            </div>
        </div>

        {{-- Product Model & Brand --}}
        <div class="form-row">
            <div class="form-row-title">

            </div>
            <div class="form-row-body">
                
            </div>
        </div>

        {{-- --}}
        <div class="form-row">
            <div class="form-row-body buttonArea">
                <button type="reset" class="resetButton">{{ trans('product.reset') }}</button>
                <button type="submit" class="submitButton">{{ trans('product.submit') }}</button>
            </div>
        </div>
    </form>