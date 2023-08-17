let table = new DataTable('#myTable', {
    "order": [
        [2, "desc"],
        [3, "desc"],
    ]
});


/**
 * Observer
 * 
 */

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const orderId = entry.target.dataset.orderId;
            if (entry.target.dataset.status === 'New') {
                // AJAX request to update order status to "Received" with CSRF token
                fetch(`/api/update-order-status/${orderId}`, {
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': csrfToken // Add the CSRF token to the headers
                    },
                })
                .then(response => response.json()) // Parse the JSON response
                .then(data => {
                    // Handle the response data here
                    console.log('订单状态已更新为:', data);
                    // You can update the UI or perform any other actions based on the data
                })
                .catch(error => {
                    console.error('请求出错:', error);
                    // Handle any error that occurred during the request
                });
            }
        }
    });
});

document.querySelectorAll('.order').forEach((orderElement) => {
    observer.observe(orderElement);
});

const pusher = new Pusher('771599bd4947d3ad7e41', {
    encrypted: true,
    cluster: 'ap1',
});

const channel = pusher.subscribe('order-status');
channel.bind('App\\Events\\NewOrderNotification', (data) => {
    // Handle the notification count update here, e.g., update the red dot count
    console.log('Received new order notification');
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