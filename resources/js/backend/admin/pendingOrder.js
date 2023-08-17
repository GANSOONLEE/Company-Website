let table = new DataTable('#myTable', {
    "order": [
        [2, "asc"],
        [3, "asc"],
    ]
});

$('.paginate_button').click(function(event){

    document.querySelectorAll('.order').forEach((orderElement) => {
        observer.observe(orderElement);
    });

    let order = document.querySelectorAll('.order');
    for(let i = 0; i < order.length; i++){
        order[i].addEventListener('click', viewOrderDetail)
    }

});

/* ———————————————————— Order Detail ———————————————————— */

$('.order').click(function(event) {
    let orderID = $(this).data('order-id');
    window.location.href = `/admin/admin-view-order/${orderID}`;
});

function viewOrderDetail(){
    let orderID = $(this).data('order-id');
    window.location.href = `/admin/admin-view-order/${orderID}`;
}