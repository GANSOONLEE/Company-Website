
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
            datalistNameListCar.innerHTML = `@foreach ($brands as $brand)
                    <option value="{{ $brand['brandName'] }}">
                @endforeach`

        const inputNameListModel = document.createElement('input');
            inputNameListModel.classList.add('form-control', 'caps');
            inputNameListModel.setAttribute('list', 'productNameList-Model');
            inputNameListModel.placeholder = `{{trans('product.car-model')}}`;
            inputNameListModel.name = 'productNameList-Model[]';

        
        // 將新建元素加入到父元素中
        addInputName.appendChild(inputNameListCar);
        addInputName.appendChild(datalistNameListCar);
        addInputName.appendChild(inputNameListModel);
        inputContainerName.appendChild(addInputName);

    }

    let i = 0;


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
                inputBrandListBrandText.addEventListener('keyup', changeIcon)

                var imgElement = document.createElement('img');

                imgElement.setAttribute('class', 'brand-logo');
                imgElement.setAttribute('style', 'width: 50px; margin-left: auto; outline: none; border: none;');
                imgElement.setAttribute('src', '');
                imgElement.setAttribute('alt', '');
            
            inputBrandListBrand.classList.add('input', 'display-row');
            inputBrandListBrand.appendChild(inputBrandListBrandText);
            inputBrandListBrand.appendChild(imgElement);

        const inputBrandListImage = document.createElement('div');
            inputBrandListImage.classList.add('image-brand');
            
            const inputBrandListImageLabel = document.createElement('label');
                inputBrandListImageLabel.classList.add('brand-image-label');
                inputBrandListImageLabel.setAttribute('for', `brand-image-${i}`);
                inputBrandListImageLabel.innerHTML = '<i class="fa-solid fa-upload"></i>';

            const inputBrandListImageContainer = document.createElement('input');
                inputBrandListImageContainer.name = 'image-brand[]';
                inputBrandListImageContainer.id = `brand-image-${i}`;
                inputBrandListImageContainer.setAttribute('type', 'file');
                inputBrandListImageContainer.setAttribute('accept', '.jpg, .png, .jpeg, .bmp');

        i++;

        inputBrandListImage.appendChild(inputBrandListImageLabel);
        inputBrandListImage.appendChild(inputBrandListImageContainer);
            
        // <div class="image-brand">
        //     <label class="brand-image-label" for="brand-image">
        //         <i class="fa-solid fa-upload"></i>
        //     </label>
        //     <input name="image-brand[]" id="brand-image" type="file" accept=".jpg, .png, .jpeg, bmp">
        // </div>


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
        addInputBrand.appendChild(inputBrandListImage);
        inputContainerBrand.appendChild(addInputBrand);
        
        function changeIcon(){
            let closestBrandLogo = inputBrandListBrand.querySelector('.brand-logo');
            if (closestBrandLogo) {
                const brand = inputBrandListBrandText.value;
                const svgUrl = `/images/brand logo/${brand}.svg`;

                fetch(svgUrl, { method: 'HEAD' })
                .then(response => {
                    if (response.ok) {
                        closestBrandLogo.src = svgUrl;
                    } else {
                        closestBrandLogo.src ='';
                    }
                })
                .catch(error => {
                    console.error('Error: ', error);
                });
            }else{
                closestBrandLogo.src = ''
            }
        }
    }
    

    window.addEventListener('load', function () {
        let brandTextInput = document.querySelector('[name="productBrandList-Brand[]"]');
        console.log(brandTextInput);
        brandTextInput.addEventListener('keyup', changeIcon)

        function changeIcon() {
            let closestBrandLogo = this.parentElement.querySelector('.brand-logo');
            if (closestBrandLogo) {
                let brand = this.value;
                let svgUrl = `/images/brand logo/${brand}.svg`;
                if (svgUrl) {
                    console.log(brand, svgUrl)
                    fetch(svgUrl, { method: 'HEAD' })
                    .then(response => {
                        if (response.ok) {
                            closestBrandLogo.src = svgUrl;
                        } else {
                            closestBrandLogo.src = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error: ', error);
                    });
                }
            }else{
                closestBrandLogo.src = ''
            }
        }
    })


</script>

    
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        

        {{-- Upload Image New --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text request">
                    {{ trans('product.image') }}
                </p>
            </div>
            <div class="form-row-body image">

                <div class="form-row-body-container control">
                    <i class="fa-solid fa-angle-left" id="previousButton"></i>
                </div>

                <div class="form-row-body-container display" id="images-thumble">
                    <div id="img-container" class="display-row">

                    </div> 
                </div>
                <div class="form-row-body-container control">
                    <i class="fa-solid fa-angle-right" id="nextButton"></i>
                </div>
            </div>
            <input type="file" id="file" multiple accept="image/*" name="uploadFiles[]"/>
        </div>

        {{-- product Name List = Car Model --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text request">
                    {{ trans('product.name-list') }} : PROTON SAGA
                </p>
            </div>
            <div class="form-row-body display-row">
                <div class="display-column" id="inputContainerName">
                    <div class="form-input display-row">
                        <input required class="input form-control caps" list="productNameList-Car" placeholder="{{trans('product.car')}} : PROTON" name="productNameList-Car[]">
                        <datalist id="productNameList-Car">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand['brandName'] }}">
                            @endforeach
                        </datalist>
                        <input required class="input form-control caps" type="text" placeholder="{{trans('product.car-model')}} : SAGA" name="productNameList-Model[]">
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
                        <div class="input display-row">
                            <input class="form-control" type="text" placeholder={{trans('product.brand')}}  name="productBrandList-Brand[]" required>
                            <img class="brand-logo" style="width: 50px;margin-left:auto" src="" alt="">
                        </div>
                        <div class="input">
                            <input class="form-control" type="text" placeholder="{{trans('product.fzcode')}}"  name="productBrandList-FZcode[]">
                        </div>
                        <div class="image-brand">
                            <label class="brand-image-label" for="brand-image">
                                <i class="fa-solid fa-upload"></i>
                            </label>
                            <input name="image-brand[]" id="brand-image" type="file" accept=".jpg, .png, .jpeg, .bmp">
                        </div>
                        <button id="addInputBrandListBtn" type="button" class="form-control">
                            <i class="fa-solid fa-plus"></i>
                            <p class="button-text">Add</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Category --}}
        <div class="form-row">
            <div class="form-row-title">
                <p class="form-row-title-text request">
                    {{ trans('product.catelog') }}
                </p>
            </div>
            <div class="form-row-body">
                <div class="form-row-body-input">
                    <label for="">
                        <input required list="categoryList" class="form-input form-control" type="text" name="productCatelog" placeholder="{{trans('product.category')}}">
                        <datalist id="categoryList">
                            @foreach ($categories as $category) 
                                <option value="{{ $category->categoryName }}">
                            @endforeach
                        </datalist>
                    </label>
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

                    <input class="form-check-input" id="Origin" type="radio" name="productType" value="Origin">
                    <label class="form-check-label" for="Origin">
                        <div required class="form-radio">Original</div>
                    </label>
                        
                    <input class="form-check-input" id="Non-Origin" type="radio" name="productType" value="Non-Origin">
                    <label class="form-check-label" for="Non-Origin">
                        <div required class="form-radio">Non-Original</div>
                    </label>

                    <input class="form-check-input" id="Recond" type="radio" name="productType" value="Recond">
                    <label class="form-check-label" for="Recond">
                        <div required class="form-radio">Recond</div>
                    </label>
                </div>
            </div>
        </div>

        {{-- Button --}}
        <div class="form-row">
            <div class="form-row-body buttonArea">
                <button type="reset" id="resetButton" class="resetButton">{{ trans('product.reset') }}</button>
                <button type="submit" id="submit" class="submitButton">{{ trans('product.submit') }}</button>
            </div>
        </div>

    <script>
        let buttonNameList = document.querySelector('#addInputNameListBtn');
        buttonNameList.addEventListener('click', addInputNameList);

        let buttonBrandList = document.querySelector('#addInputBrandListBtn');
        buttonBrandList.addEventListener('click', addInputBrandList);

    </script>