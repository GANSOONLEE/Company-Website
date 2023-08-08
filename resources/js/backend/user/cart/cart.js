
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
        const removeQuantityButton = document.createElement('button');
        removeQuantityButton.type = 'button';
        removeQuantityButton.id = 'removeQuantityButton';
        removeQuantityButton.innerText = '-';
        removeQuantityButton.classList.add( 'quantity-button', 'remove');

        const displayQuantity = document.createElement('div');
        displayQuantity.id = 'displayQuantityContainer';
        displayQuantity.classList.add('display-quantity');
        displayQuantity.innerText = this.product_quantity;

        const addQuantityButton = document.createElement('button');
        addQuantityButton.type = 'button';
        addQuantityButton.id = 'addQuantityButton';
        addQuantityButton.innerText = '+';
        addQuantityButton.classList.add('quantity-button', 'add');

        const footer = element.querySelector('.product-card-footer')
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



// #endregion