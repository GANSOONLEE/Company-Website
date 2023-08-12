
/* ———————————————————— OrderCard::class ———————————————————— */

class OrderCard{

    cardElement;
    orderID;

    constructor(cardElement) {
        this.cardElement = cardElement;
        this.orderID = cardElement.querySelector('.order-id').innerText;
        $(this.cardElement).click((event) => {
            this.sendData(event.currentTarget);
        });
    }


    sendData(){
        const self = this;
        $.ajax({
            url: '/api/user-view-order',
            type: 'post',
            data: {'orderID': this.orderID},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
              success: function(data) {
                console.log(data);
                self.updateStatus(data.order);
            },
              error: function(xhr, status, error) {
                console.log('AJAX Error:',xhr,status, error);
            }
        })
    }

    updateStatus(status){
        $('#order-item-list').empty();

        // Define Variable
        const orderID = $('#orderID');
        const orderReceivedDate = $('#orderReceivedDate');
        const orderReceivedTime = $('#orderReceivedTime');
        const orderStatus = document.querySelector('#orderStatus');

        // Information Init
        orderID.text(status['orderID'])
        orderStatus.innerText = status['orderStatus'];

        const parsedOrderContent = JSON.parse(status['orderContent']);
    
        // 遍歷數組中的每個元素
        parsedOrderContent.forEach(item => {

            const orderUnit = document.createElement('div');
                orderUnit.classList.add('order');
            
                const itemInfo = document.createElement('div');
                    itemInfo.classList.add('item-info');

                    const itemID = document.createElement('p');
                        itemID.classList.add('item-id');
                        itemID.id = 'ItemID';
                        itemID.innerText = item.id;

                    const itemBrand = document.createElement('p');
                        itemBrand.classList.add('item-brand');
                        itemBrand.id = 'ItemBrand';
                        itemBrand.innerText = item.brand;

                itemInfo.appendChild(itemID);
                itemInfo.appendChild(itemBrand);

                const itemQuantity = document.createElement('div');
                    itemQuantity.classList.add('item-quantity');

                    const ItemQuantity = document.createElement('p');
                        ItemQuantity.id = 'ItemQuantity';
                        ItemQuantity.innerText = item.quantity;

                itemQuantity.appendChild(ItemQuantity);

            orderUnit.appendChild(itemInfo)
            orderUnit.appendChild(itemQuantity)

            document.querySelector('#order-item-list').appendChild(orderUnit)
            document.querySelector('#orderModel').classList.add('show')
        });
    }
    
}

/* —————————————————— Onload —————————————————— */

window.onload = function ready(){

    /* ———— Init Class ———— */
    let orderCards = document.querySelectorAll('.card');
    let orderCardInstanceArray = [];
    for(let i = 0; i < orderCards.length; i++){
        let orderCardInstance = new OrderCard(orderCards[i]);
        orderCardInstanceArray.push(orderCardInstance);
    }

    /* Init Modal */
    $('#closeModalButton').click(function(event){
        document.querySelector('#orderModel').classList.remove('show')
    })

    /* Close Modal */
    $('#orderModel').click(function(event){
        event.target.classList.remove('show');
    });

    

}