
/** ———————————————————————————————————— object —————————————————————————————————————————— */

// #region

/**
 * @param {Object} CartCard - A unit who display the product with card
 */

class CartCard{

    product_id;
    product_quantity;
    product_brand;
    element;
    cart_id;

    constructor(element){
        this.element = element;
        this.product_id = element.getAttribute('data-product-id')
        this.product_quantity = parseInt(element.getAttribute('data-quantity')); 
        this.product_brand = element.getAttribute('data-brand');
        this.cart_id = element.getAttribute('data-cart');
        
        this.structureInit(element);
    }

    structureInit(element){

        /** control quantity button  */
        const removeQuantityButtonIcon = document.createElement('i');
        removeQuantityButtonIcon.classList.add('fa-solid','fa-minus')

        const removeQuantityButton = document.createElement('button');
        removeQuantityButton.type = 'button';
        removeQuantityButton.id = 'removeQuantityButton';
        removeQuantityButton.classList.add( 'quantity-button', 'remove');
        removeQuantityButton.appendChild(removeQuantityButtonIcon)
        
        const displayQuantity = document.createElement('div');
        displayQuantity.id = 'displayQuantityContainer';
        displayQuantity.classList.add('display-quantity');
        displayQuantity.innerText = this.product_quantity;

        const addQuantityButtonIcon = document.createElement('i');
        addQuantityButtonIcon.classList.add('fa-solid','fa-plus')

        const addQuantityButton = document.createElement('button');
        addQuantityButton.type = 'button';
        addQuantityButton.id = 'addQuantityButton';
        addQuantityButton.classList.add('quantity-button', 'add');
        addQuantityButton.appendChild(addQuantityButtonIcon)
        
        const footer = element.querySelector('[data-column="Quantity"]')
        footer.appendChild(removeQuantityButton);
        footer.appendChild(displayQuantity);
        footer.appendChild(addQuantityButton);

        this.eventListenerInit(removeQuantityButton, displayQuantity, addQuantityButton);
    }

    eventListenerInit(removeQuantityButton, displayQuantity, addQuantityButton){

        // remove quantity
        removeQuantityButton.addEventListener('click', () => {
            this.removeQuantity(displayQuantity);
        });

        // add quantity
        addQuantityButton.addEventListener('click', () => {
            this.addQuantity(displayQuantity);
        });

    }

    removeQuantity(displayQuantity){
        let product_quantity = parseInt(displayQuantity.innerText);
        if(product_quantity === 0){
            return;
        }
        product_quantity -= 1;
        this.refreshQuantity(displayQuantity, product_quantity)
    }

    addQuantity(displayQuantity){
        let product_quantity = parseInt(displayQuantity.innerText);
        product_quantity += 1;
        
        this.refreshQuantity(displayQuantity, product_quantity)
    }

    refreshQuantity(displayQuantity, product_quantity){
        displayQuantity.innerText = product_quantity;
        this.element.setAttribute('data-quantity', product_quantity)
        this.product_quantity = product_quantity;
        this.updateQuantity(this.product_brand);
    }

    updateQuantity(){

        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {'ID': this.cart_id ,'productID': this.product_id, 'productBrand': this.product_brand, 'quantity': this.product_quantity},
            url: '/api/update-cart-quantity',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
              console.log(data)
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:',xhr,status, error);
            }
        });
    }

}

// #endregion

/** ———————————————————————————————————— function —————————————————————————————————————————— */

/**
 * generator order with select products
 * 
 */

// #region

function createOrder(){

    /** @param {Array} selectProduct </br>The set of the select product, sort with category A-Z */
    let selectProduct = document.querySelectorAll('input[type="checkbox"]')

    /** have any product selected? */
    if(!selectProduct || selectProduct.length === 0){
        console.log('Can\'t found any product selected')
        return;
    }

    try{

        let orderElement = [];

        for(i=0;i<selectProduct.length;i++){

            let data = [
                {
                    'productID': selectProduct[i].product_id,
                    'productQuantity': selectProduct[i].product_quantity,
                    'productBrand': selectProduct[i].product_brand,
                }
            ];

            orderElement = data;

            console.log(selectProduct[i]);
            console.log(data)
        }

        generatedOrder(orderElement);
        console.info(orderElement)
    }catch(error){
        console.error(`Error: ${error}`)
    }
}

/**
 * follow the info to generate order and send it
 * 
 */

function generatedOrder(orderElement){

    try{
        // get the csrfToken
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // send order inform to backend
        // #TODO send order inform to backend
        $.ajax({
            type     : 'post',
            dataType : 'json',
            data     : orderElement,
            url      : '/api/generate-order',
            headers  : {
            'X-CSRF-TOKEN': csrfToken
            },
            success: function(data) {
                console.log(data)
            },
            error: function(xhr, status, error) {
                console.error(`Server status: ${status}\nError: ${error}`);
            }
        });
    }catch(error){
        console.error(error)
    }
}

// #endregion

/** ———————————————————————————————————— initialization —————————————————————————————————————————— */

// #region 

function initialization(){


    // 將 class="product-card" 的dom元素注冊成 CartCard 實例
    const cards = document.querySelectorAll('.product-card')
    let productCardInstances = [];
    for(let i=0;i<cards.length;i++){
        const cardInstance = new CartCard(cards[i]);
        productCardInstances.push(cardInstance);
    }

}

initialization()


// #endregion

/** ———————————————————————————————————— event listener —————————————————————————————————————————— */

// #region 

/**  */

let checkOrder = document.querySelector('#checkOrder');
checkOrder.addEventListener('click', checkOrderForm)

function checkOrderForm(){
    
}

function generate(){
    
}

// #endregion

/** ————————————————————————————— Data Table ————————————————————————————— */

let table = new DataTable('#myTable', {
    
});

$(document).ready(function() {
    // 监听点击事件，选择特定的 <tr> 元素
    $('tr.product-card').click(function(event) {

        $('button.quantity-button').click(function(event) {
            // 阻止事件冒泡，避免触发父元素的点击事件，包括 checkbox 的点击事件
            event.stopPropagation();
            // 在这里添加你希望按钮点击后执行的代码
        });

        $('.checkbox').click(function(event) {
            // 阻止事件冒泡，避免触发父元素的点击事件
            event.stopPropagation();
        });
        
        // 获取被点击的 <tr> 元素内部的 checkbox
        var checkbox = $(this).find('.checkbox');
        
        // 切换 checkbox 的选中状态
        checkbox.prop('checked', !checkbox.prop('checked'));
    });

    $('#selectAll').click(function(event){
        // 阻止事件冒泡，避免触发父元素的点击事件
        event.stopPropagation();
    
        // 获取全选按钮的状态
        var selectAllChecked = $(this).prop('checked');
        
        // 将所有具有 .checkbox 类的复选框的状态设置为与全选按钮相同
        $('.checkbox').prop('checked', selectAllChecked);
    })
});

/* ———————————————————— Model ———————————————————— */

$(document).ready(function() {

    $('#checkOrder').click(function(event){
        var selectedProductIds = [];

        // 遍历选中的复选框，获取其 data-id 属性值
        $('.checkbox:checked').each(function() {
            selectedProductIds.push($(this).data('id'));
        });

        var email = document.querySelector('#email').innerText;

        // 使用 AJAX 发送数据到指定的路由
        $.ajax({
            url: '/api/create-order',
            type: 'POST',
            data: { productIds: selectedProductIds , 'email': email},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // 处理响应
                console.log(response);
                location.reload();
            },
            error: function(error) {
                // 处理错误
                console.error(error);
            }
        });
    });

});