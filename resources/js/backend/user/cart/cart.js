
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
        this.product_id = element.getAttribute('data-id')
        this.product_quantity = parseInt(element.getAttribute('data-quantity')); 
        this.product_brand = element.getAttribute('data-brand');
        this.cart_id = element.getAttribute('data-cart-id');
        
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
        console.log(
            this.cart_id,
            this.product_id,
            this.product_brand,
            this.product_quantity
        )
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {
                'cartID': this.cart_id,
                'productID': this.product_id,
                'productBrand': this.product_brand,
                'quantity': this.product_quantity
            },
            url: '/api/update-cart-quantity',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                // location.reload()
                
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
                // location.reload();
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


/** ————————————————————————————— Data Table ————————————————————————————— */

let table = new DataTable('#myTable', {
    "order": [
        [1, "asc"],
        [2, "asc"],
        [3, "asc"],
    ]
});

$(document).ready(function() {

    // 监听点击事件，选择特定的 <tr> 元素
    $('tr.product-card').click(function(event) {

        $('button.quantity-button').click(function(event) {
            event.stopPropagation();
        });

        $('.checkbox').click(function(event) {
            event.stopPropagation();
            $(this).closest('tr.product-card').click();
            // return false;
        });

        var checkbox = $(this).find('.checkbox');
        checkbox.prop('checked', !checkbox.prop('checked'));

        let allChecked = $('.checkbox:checked').length === $('.checkbox').length;
        $('#selectAll').prop('checked', allChecked)
    });

    $('#selectAll').click(function(event){
        event.stopPropagation();
    
        var selectAllChecked = $(this).prop('checked');
        
        $('.checkbox').prop('checked', selectAllChecked);
    })
});

/* ———————————————————— Send Order ———————————————————— */


$(document).ready(function() {
    $('#generatingOrder').click(function(event){
        generateData();
    });
});

function generateData(){
    let itemChecked;
    let selectedProductIds = [];

    let selectAllChecked = $('#selectAll').prop('checked');
    
    itemChecked = selectAllChecked ? itemChecked = $('.checkbox') : itemChecked = $('.checkbox:checked');

    /** have any product selected? */
    if(!itemChecked || itemChecked.length === 0){
        confirm('Can\'t found any product selected')
        return;
    }
    
    itemChecked.each(function() {
        let id = this.parentNode.parentNode.getAttribute('data-id');
        let brand = this.parentNode.parentNode.getAttribute('data-brand');
        let quantity = this.parentNode.parentNode.getAttribute('data-quantity');

        if(quantity === '0'){
            confirm('Can\'n select item quantity are 0')
            throw new Error('Can\'n select item quantity 0');
            return false;
        }

        selectedProductIds.push({
            id: id,
            brand: brand,
            quantity: quantity
        });
    });


    let email = document.querySelector('#email').innerText;

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
            location.reload();
            // confirm('Order have been create');
            // console.log(response);
        },
        error: function(error) {
            // 处理错误
            console.error(error);
        }
    });
}

/* ———————————————————— Send Order ———————————————————— */


$(document).ready(function() {
    $('#checkOrder').click(function(event){
        sendData();
    });
});

function sendData(){
    let itemChecked;
    let selectedProductIds = [];
    
    itemChecked = $('.checkbox:checked');

    /** have any product selected? */
    if(!itemChecked || itemChecked.length === 0){
        confirm('Can\'t found any product selected')
        return;
    }

    // console.log(itemChecked)

    // 遍历选中的复选框，获取其 data-id 属性值
    itemChecked.each(function() {
        // let id = $(this).data('id');
        // let quantity = $(this).closest('tr').data('quantity');
        let id = this.parentNode.parentNode.getAttribute('data-id');
        let brand = this.parentNode.parentNode.getAttribute('data-brand');
        let quantity = this.parentNode.parentNode.getAttribute('data-quantity');

        if(quantity === '0'){
            confirm('Can\'n select item quantity are 0')
            throw new Error('Can\'n select item quantity 0');
            return false;
        }

        selectedProductIds.push({
            id: id,
            brand: brand,
            quantity: quantity
        });
    });


    let email = document.querySelector('#email').innerText;

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
            location.reload();
            // confirm('Order have been create');
            // console.log(response);
        },
        error: function(error) {
            // 处理错误
            console.error(error);
        }
    });

    setTime
}