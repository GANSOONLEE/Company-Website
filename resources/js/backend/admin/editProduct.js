let table = new DataTable('#myTable', {
    // options
});

/**
 * initialization Event Listener after window load finish
 * @method init()
 */

window.onload = function init(){
    new EventListener('.paginate_button ', 'click', 'true', refreshWindows)
    new EventListener('.sorting  ', 'click', 'true', refreshWindows)
    
    new EventListener('#data-row', 'click', 'true', selectProducts);
    new EventListener('#data-row', 'dblclick', 'true', getData);

    // Form event
    new EventListener('#deleteButton', 'click', 'false', deleteProduct);
    new EventListener('#addNameButton', 'click', 'false', addNameList);
    new EventListener('#addBrandButton', 'click', 'false', addBrandList);
    
    alertonload();
}

/**
 * Register function in this above
 */

    // #region

    function alertonload(){
        let alertForm = document.querySelector('#alertForm')
        let bsAlert = new bootstrap.Alert(alertForm)
        setTimeout(function() {
            bsAlert.close();
        }, 3000);
    }

    /**
     * refresh another page
     * 
     */

    function refreshWindows(){
        console.log('set')
        new EventListener('#data-row', 'click', 'true', selectProducts);
        new EventListener('#data-row', 'dblclick', 'true', getData);
    }

    /**
     * getData from row then select
     * 
     */

    function getDataValue(selector) {
        return this.querySelector(selector).innerText;
    }

    function editProductForm(data){
        const modal = new bootstrap.Modal(document.querySelector('#editProductForm'));

        console.log(data.productBrand)

        modal.show();
        document.querySelector('[name="productID"]').value = data.productID;
        // document.querySelector('[name="productName"]').value = data.productName;
        // document.querySelector('[name="productBrand"]').value = data.productBrand;

        function selectElement(id, valueToSelect) {    
            let element = document.getElementById(id);
            element.value = valueToSelect;
        }
        selectElement('productCatelogList', data.productCatelog);
        selectElement('productTypeList', data.productType);
        selectElement('productStatusList', data.productStatus);

        /**
         *  reset
         */

        let containerBrand = document.querySelectorAll('#productBrandListContainer');
        if(containerBrand){
            for(i=0;i<containerBrand.length;i++){
                containerBrand[i].remove();
            }
        }

        let containerName = document.querySelectorAll('#productNameListContainer');
        if(containerName){
            for(i=0;i<containerName.length;i++){
                containerName[i].remove();
            }
        }

        console.log('进入Name')
        createNameList(data);
        console.log('进入Brand')
        createBrandList(data);
        console.log('结束')
    }
      
    function getData() {

        const productID = getDataValue.call(this, 'td[data-type="productID"]');
        const productName = getDataValue.call(this, 'td[data-type="productName"]');
        const productBrand = getDataValue.call(this, 'td[data-type="productBrand"]');
        const productCatelog = getDataValue.call(this, 'td[data-type="productCatelog"]');
        const productType = getDataValue.call(this, 'td[data-type="productType"]');
        const productStatus = getDataValue.call(this, 'div[data-type="productStatus"]');
        
        const productNameList = getDataValue.call(this, 'td[data-type="productNameList"]');

        const productBrandList = getDataValue.call(this, 'td[data-type="productBrandList"]');

        // Pack the rowData
        const data = {
            productID,
            productName,
            productBrand,
            productCatelog,
            productType,
            productStatus,
            productNameList,
            productBrandList,
        };

        // Realization bootstrap 5 form
        editProductForm(data);
    }

    /**
     * Multichoice Operation
     * @param {Array} productSelectList the product are select
     */

    let productSelectList = [];

    function selectProducts(){
        const selectProduct = this;
        const isChecked = this.querySelector('input[type="checkbox"]').checked
        if(isChecked){
            selectProduct.querySelector('input[type="checkbox"]').checked = false;
            let targetProductId = this.getAttribute('data-product-id');
            productSelectList = productSelectList.filter(row => row["selectProductID"] !== targetProductId);
        }else{
            selectProduct.querySelector('input[type="checkbox"]').checked = true;
            let selectProductID = this.getAttribute('data-product-id');
            let selectProductArray = {};
            selectProductArray = {
                selectProduct,
                selectProductID,
            };
            productSelectList.push(selectProductArray);
        };
    }

    

    // #endregion

/**
 *  @param {Class} EventListener
 */

// #region
   
class EventListener{

    element;
    trigger;
    isSelectedAll;
    callFunctionName;

    /**
     * @param {string} element What element what be listen?
     * @param {string} trigger How the element trigger?
     * @param {boolean} isSelectedAll Is lots of element want to be listen?
     * @param {function} callFunctionName If element trigger call where function?
     */

    constructor(element, trigger, isSelectedAll, callFunctionName){
        const elementWillListen = document.querySelectorAll(element);

        if (typeof callFunctionName !== 'function') {
            console.error('Invalid function name provided!');
            return    
        }

        if(isSelectedAll === 'true'){
            for(i = 0; i < elementWillListen.length; i++){
                elementWillListen[i].addEventListener(trigger, callFunctionName);
            }
        }else{
            elementWillListen[0].addEventListener(trigger, callFunctionName);
        }
    };
}

// #endregion

function getEmail() {
    var name = 'email=';
    var ca = document.cookie.split(';');
    console.log(ca);
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i].trim();
      if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
}

/**
 * Updata product information
 * @param {string} email The record who edit
 */

function updataInformation(){
    const encodedEmail = decodeURIComponent(getEmail());
    console.log(encodedEmail)
}


/**
 * Form Event
 */

function deleteProduct(){

    const productID = document.querySelector('[name="productID"]').value;

    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {'productID': productID},
        url: '/api/delete-product',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            location.reload();
        },
        error: function(xhr, status, error) {
            location.reload();
        }
    });
}

/**
 * create element or add new column
 */

function createNameList(data){
    const dataArrayName = JSON.parse(data['productNameList']);
    const formName = document.querySelector('#productNameListRepeat');

    

    dataArrayName.forEach((record, index) => {
        // Container
        const container = document.createElement('div');
        container.id = 'productNameListContainer'
        container.classList.add('display-row', 'mb-3');

        //创建car input元素
        const nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.classList.add('form-control', 'text');
        nameInput.name = `productNameList-CarModel[]`;
        nameInput.value = record;
        nameInput.required = false;
        nameInput.placeholder = 'Product Name';
        
        container.appendChild(nameInput);
        formName.appendChild(container)
    })
}

function createBrandList(data){

    const dataArrayBrand = JSON.parse(data['productBrandList']);
    const formBrand = document.querySelector('#productBrandListRepeat');

    dataArrayBrand.forEach((record, index) => {

        // Container
        const container = document.createElement('div');
        container.id = 'productBrandListContainer'
        container.classList.add('display-row', 'mb-3')

        // 创建code input元素
        const codeInput = document.createElement('input');
        codeInput.type = 'text';
        codeInput.className = 'form-control';
        codeInput.name = `productBrandList-Code[]`;
        // codeInput.name = `productBrand-Code[${index}]`;
        codeInput.value = record.code || '';
        codeInput.required = false;
        codeInput.placeholder = 'Code';

        // 创建brand input元素
        const brandInput = document.createElement('input');
        brandInput.type = 'text';
        brandInput.className = 'form-control';
        brandInput.name = `productBrandList-Brand[]`;
        // brandInput.name = `productBrand-Brand[${index}]`;
        brandInput.value = record.brand || '';
        brandInput.required = false;
        brandInput.placeholder = 'Brand';

        // 创建fzcode input元素
        const fzcodeInput = document.createElement('input');
        fzcodeInput.type = 'text';
        fzcodeInput.className = 'form-control';
        fzcodeInput.name = `productBrandList-FZcode[]`;
        // fzcodeInput.name = `productBrand-FZCode[${index}]`;
        fzcodeInput.value = record.fzcode || ''; // 如果fzcode为null，则设置为空字符串
        fzcodeInput.required = false;
        fzcodeInput.placeholder = 'FZ Code';

        // 将创建的input元素添加到表单中
        container.appendChild(codeInput);
        container.appendChild(brandInput);
        container.appendChild(fzcodeInput);
        formBrand.appendChild(container)
    });
}

function addNameList(){
    const formName = document.querySelector('#productNameListRepeat');

    // Container
    const container = document.createElement('div');
    container.id = 'productNameListContainer'
    container.classList.add('display-row', 'mb-3');

    //创建car input元素
    const nameInput = document.createElement('input');
    nameInput.type = 'text';
    nameInput.classList.add('form-control', 'text');
    nameInput.name = `productNameList-CarModel[]`;
    nameInput.required = false;
    nameInput.placeholder = 'Product Name';
    
    container.appendChild(nameInput);
    formName.appendChild(container)
}

function addBrandList(){

    const formBrand = document.querySelector('#productBrandListRepeat');

    // Container
    const container = document.createElement('div');
    container.id = 'productBrandListContainer'
    container.classList.add('display-row', 'mb-3')

    // 创建code input元素
    const codeInput = document.createElement('input');
    codeInput.type = 'text';
    codeInput.className = 'form-control';
    codeInput.name = `productBrandList-Code[]`;
    codeInput.required = false;
    codeInput.placeholder = 'Code';

    // 创建brand input元素
    const brandInput = document.createElement('input');
    brandInput.type = 'text';
    brandInput.className = 'form-control';
    brandInput.name = `productBrandList-Brand[]`;
    brandInput.required = false;
    brandInput.placeholder = 'Brand';

    // 创建fzcode input元素
    const fzcodeInput = document.createElement('input');
    fzcodeInput.type = 'text';
    fzcodeInput.className = 'form-control';
    fzcodeInput.name = `productBrandList-FZcode[]`;
    fzcodeInput.required = false;
    fzcodeInput.placeholder = 'FZ Code';

    // 将创建的input元素添加到表单中
    container.appendChild(codeInput);
    container.appendChild(brandInput);
    container.appendChild(fzcodeInput);
    formBrand.appendChild(container);
}