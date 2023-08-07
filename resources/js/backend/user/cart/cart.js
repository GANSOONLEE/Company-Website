
/** ———————————————————————————————————— object —————————————————————————————————————————— */

// #region

/**
 * @param {Object} CartCard - A unit who display the product with card
 */

class CartCard{

    product_id;
    product_quantity;
    product_brand;

    constructor(){
        product_id = this.getAttributes('data-product-id'); 
        product_quantity = this.getAttributes('data-quantity'); 
        product_brand = this.getAttributes('data-brand'); 
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
        // #BUG Fix the route can't work
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


createOrder()