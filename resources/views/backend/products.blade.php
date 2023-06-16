<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="{{asset('css\app.css')}}" rel="stylesheet">
    <link href="{{asset('css\backend\products.css')}}" rel="stylesheet">
    <title>{{trans('product.title')}}</title>
</head>
<body>
    @include('ui.sidebar')

    @if($models->isEmpty() || $catelogs->isEmpty())
        @include('ui.alert')
    @endif
    
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
                        <input class="form-check-input" type="radio" name="productCatelog" id="{{ $option['catelogName'] }}" value="{{ $option['catelogName'] }}">
                        <label class="form-check-label" for="{{ $option['catelogName'] }}">{{ $option['catelogName'] }}</label>
                    </div>
                @endforeach
            </div>

            
            <label class="row-title">{{trans('product.type')}}</label>
            <div class="form-row">
                {{-- 類型 --}}
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="productType" value="Non-Origin">
                    <label class="form-check-label" for="exampleRadios1">Non-Original</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="productType" value="Origin">
                    <label class="form-check-label" for="exampleRadios1">Original</label>
                </div>
            </div>


            <label class="row-title">主要车款和车款型号：</label>
            <div class="form-column" id="inputContainer">
                {{-- 车款和型号 --}}

                {{-- 主要 --}}
                <div class="input-group mb-3" style="display: flex; flex-direction: row;" id="primaryInputGroup">
                    <input style="text-transform: uppercase;" class="form-control primary-input" list="primaryBrandList" id="primaryBrand" placeholder={{trans('product.model')}} name="primaryBrand">
                    <datalist id="primaryBrandList">
                        @foreach ($models as $option)
                            <option value="{{ $option['modelName'] }}">
                        @endforeach
                    </datalist>
                    <input style="text-transform: uppercase;" class="form-control primary-input" type="text" placeholder={{trans('product.brand')}} name="primaryModel">
                    <button id="addInputBtn" type="button">添加输入框</button>
                </div>
            </div>

            <label class="row-title">{{trans('product.code')}}</label>
            <div class="form-row">
                {{-- 產品編號 --}}
                <label for="productCode" class="label">{{trans('product.code')}}</label>
                {{-- <input class="inputText"  type="text" name="productCode" id="productCode" autocomplete="off" required> --}}
                <input name="productCode" id="productCode" class="form-control" type="text" placeholder={{trans('product.code')}} name="primaryModel" autocomplete="off" required>
            </div>


            <div class="form-row">
                {{-- 產品圖片 --}}
                {{-- <div class="input-group mb-3">
                    <input type="file" class="form-control" id="productImage">
                    <label class="input-group-text" for="productImage" name="productImage" required>Upload</label>
                </div> --}}
                <div class="container">
                    <input type="file" name="productImage" id="productImage" required accept=".jpg, .png, .jpeg">
                    <label for="productImage" class="label">{{trans('product.image')}}</label>
                </div>
            </div>

            
            {{-- 提交按鈕 --}}
            <button type="submit" class="submitBtn">{{trans('product.submit')}}</button>
        </form> 
    </div>
</body>
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
  newSecondaryBrand.placeholder = 'Type to search...';
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
  newSecondaryModel.placeholder = 'Default input';
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
</html>