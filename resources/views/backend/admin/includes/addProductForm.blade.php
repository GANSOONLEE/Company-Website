
<script>

    function addInputNameList(){

        const inputContainerName = document.querySelector('#inputContainerName');

        // 創建新的元素
        const addInputName = document.createElement('div');
            addInputName.classList.add('form-input', 'display-row')

        const inputNameListCar = document.createElement('input');
            inputNameListCar.classList.add('form-control', 'caps');
            inputNameListCar.setAttribute('list', 'productNameList-Car');
            inputNameListCar.placeholder = `{{trans('product.car')}}`;
            inputNameListCar.name = 'productNameList-Car[]';

            
        const datalistNameListCar = document.createElement('datalist');
            datalistNameListCar.id = 'productNameList-Car';
            datalistNameListCar.innerHTML = `@foreach ($models as $option)
                    <option value="{{ $option['modelName'] }}">
                @endforeach`

        const inputNameListModel = document.createElement('input');
            inputNameListModel.classList.add('form-control', 'caps');
            inputNameListModel.setAttribute('list', 'productNameList-Model');
            inputNameListModel.placeholder = `{{trans('product.model')}}`;
            inputNameListModel.name = 'productNameList-Model[]';

        
        // 將新建元素加入到父元素中
        addInputName.appendChild(inputNameListCar);
        addInputName.appendChild(datalistNameListCar);
        addInputName.appendChild(inputNameListModel);
        inputContainerName.appendChild(addInputName);

    }


    function addInputBrandList(){

        const inputContainerBrand = document.querySelector('#inputContainerBrand');

        // 創建新的元素
        const addInputBrand = document.createElement('div');
            addInputBrand.classList.add('form-input', 'display-row')

        const inputBrandListCode = document.createElement('div');

            const inputBrandListCodeText = document.createElement('input');
                inputBrandListCodeText.setAttribute('type', 'text');
                inputBrandListCodeText.classList.add('form-control');
                inputBrandListCodeText.placeholder = (`{{trans('product.code')}}`);
                inputBrandListCodeText.name = ('productBrandList-Code[]');

            inputBrandListCode.classList.add('input');
            inputBrandListCode.appendChild(inputBrandListCodeText);


        const inputBrandListBrand = document.createElement('div');

            const inputBrandListBrandText = document.createElement('input');
                inputBrandListBrandText.setAttribute('type', 'text');
                inputBrandListBrandText.classList.add('form-control');
                inputBrandListBrandText.placeholder = (`{{trans('product.brand')}}`);
                inputBrandListBrandText.name = ('productBrandList-Brand[]');

            inputBrandListBrand.classList.add('input');
            inputBrandListBrand.appendChild(inputBrandListBrandText);


        const inputBrandListFZCode = document.createElement('div');

            const inputBrandListFZCodeText = document.createElement('input');
                inputBrandListFZCodeText.setAttribute('type', 'text');
                inputBrandListFZCodeText.classList.add('form-control');
                inputBrandListFZCodeText.placeholder = (`{{trans('product.fzcode')}}`);
                inputBrandListFZCodeText.name = ('productBrandList-FZcode[]');

            inputBrandListFZCode.classList.add('input');
            inputBrandListFZCode.appendChild(inputBrandListFZCodeText);
        
        // 將新建元素加入到父元素中
        addInputBrand.appendChild(inputBrandListCode);
        addInputBrand.appendChild(inputBrandListBrand);
        addInputBrand.appendChild(inputBrandListFZCode);
        inputContainerBrand.appendChild(addInputBrand);

        
    }

    // 初始化設置
    window.onload = function init(){
        var buttonNameList = document.querySelector('#addInputNameListBtn');
        buttonNameList.addEventListener('click', addInputNameList);

        var buttonBrandList = document.querySelector('#addInputBrandListBtn');
        buttonBrandList.addEventListener('click', addInputBrandList);
    }

</script>

    <form action={{ route('backend.admin.createdProduct') }} method="POST" enctype="multipart/form-data" class="form">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        
        {{-- Upload Image --}}
        {{-- <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text">
                    {{ trans('product.image') }}
                </p>
            </div>
            <div class="form-row-body">
                <div class="form-row-image" data-drop-id="image">
                    <input type="file" required multiple accept=".png, .jpeg, .jpg, .gif" id="uploadButton" name="images[]" style="display: block">
                    {{-- <div id="drop" class="drop-box" onclick="upload()">
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
        </div> --}}

        {{-- Upload Image New --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text request">
                    {{ trans('product.image') }}
                </p>
            </div>
            <div class="form-row-body image" id="image-input">
                <div class="form-row-body-container control">
                    <i class="fa-solid fa-angle-left" id="previousButton"></i>
                </div>
                <div class="form-row-body-container display" id="images-thumble">
                    <input type="file" multiple>
                </div>
                <div class="form-row-body-container control">
                    <i class="fa-solid fa-angle-right" id="nextButton"></i>
                </div>
            </div>
        </div>

        {{-- Product Catelog --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text request">
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
                <p class="form-row-title-text request">
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
        
        {{-- product Name List = Car Model --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text request">
                    {{ trans('product.name-list') }}
                </p>
            </div>
            <div class="form-row-body display-row">
                <div class="display-column" id="inputContainerName">
                    <div class="form-input display-row">
                        <input required class="form-control caps" list="productNameList-Car" placeholder={{trans('product.car')}} name="productNameList-Car[]">
                        <datalist id="productNameList-Car">
                            @foreach ($models as $option)
                                <option value="{{ $option['modelName'] }}">
                            @endforeach
                        </datalist>
                        <input required class="form-control caps" type="text" placeholder={{trans('product.car-model')}} name="productNameList-Model[]">
                        <button id="addInputNameListBtn" type="button" class="form-control">
                            <i class="fa-solid fa-plus"></i>
                            <p class="button-text">Add</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Model & Brand --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text request">
                    {{ trans('product.code-brand-fzcode') }}
                </p>
            </div>
            <div class="form-row-body">
                <div class="code-brand-fzcode display-column" id="inputContainerBrand">
                    <div class="form-input display-row">
                        <div class="input">
                            <input class="form-control" type="text" placeholder={{trans('product.code')}}  name="productBrandList-Code[]" required>
                        </div>
                        <div class="input">
                            <input class="form-control" type="text" placeholder={{trans('product.brand')}}  name="productBrandList-Brand[]" required>
                        </div>
                        <div class="input">
                            <input class="form-control" type="text" placeholder={{trans('product.fzcode')}}  name="productBrandList-FZcode[]">
                        </div>
                        <button id="addInputBrandListBtn" type="button" class="form-control">
                            <i class="fa-solid fa-plus"></i>
                            <p class="button-text">Add</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Button --}}
        <div class="form-row">
            <div class="form-row-body buttonArea">
                <button type="reset" class="resetButton">{{ trans('product.reset') }}</button>
                <button type="submit" class="submitButton">{{ trans('product.submit') }}</button>
            </div>
        </div>
    </form>