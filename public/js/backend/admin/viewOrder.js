/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/backend/admin/viewOrder.js ***!
  \*************************************************/
var table = new DataTable('#myTable', {
  "order": [[2, "desc"], [3, "desc"]]
});

/**
 * Observer
 * 
 */

var csrfToken = document.querySelector('meta[name="csrf-token"]').content;
var observer = new IntersectionObserver(function (entries) {
  entries.forEach(function (entry) {
    if (entry.isIntersecting) {
      var orderId = entry.target.dataset.orderId;
      if (entry.target.dataset.status === 'New') {
        // AJAX request to update order status to "Received" with CSRF token
        fetch("/api/update-order-status/".concat(orderId), {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // Add the CSRF token to the headers
          }
        }).then(function (response) {
          return response.json();
        }) // Parse the JSON response
        .then(function (data) {
          // Handle the response data here

          console.log('订单状态已更新为:', data);
          // You can update the UI or perform any other actions based on the data
        })["catch"](function (error) {
          console.error('请求出错:', error);
          // Handle any error that occurred during the request
        });

        var _table = $('#myTable').DataTable();
        _table.ajax.reload();
      }
    }
  });
});
document.querySelectorAll('.order').forEach(function (orderElement) {
  observer.observe(orderElement);
});
var pusher = new Pusher('771599bd4947d3ad7e41', {
  encrypted: true,
  cluster: 'ap1'
});
var channel = pusher.subscribe('order-status');
channel.bind('App\\Events\\NewOrderNotification', function (data) {
  // Handle the notification count update here, e.g., update the red dot count
  console.log('Received new order notification');
});
$('.paginate_button').click(function (event) {
  document.querySelectorAll('.order').forEach(function (orderElement) {
    observer.observe(orderElement);
  });
  var order = document.querySelectorAll('.order');
  for (var i = 0; i < order.length; i++) {
    order[i].addEventListener('click', viewOrderDetail);
  }
});

/* ———————————————————— Order Detail ———————————————————— */

$('.order').click(function (event) {
  var orderID = $(this).data('order-id');
  window.location.href = "/admin/admin-view-order/".concat(orderID);
});
function viewOrderDetail() {
  var orderID = $(this).data('order-id');
  window.location.href = "/admin/admin-view-order/".concat(orderID);
}
/******/ })()
;