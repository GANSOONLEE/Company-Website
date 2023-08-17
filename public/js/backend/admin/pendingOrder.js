/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/js/backend/admin/pendingOrder.js ***!
  \****************************************************/
var table = new DataTable('#myTable', {
  "order": [[2, "asc"], [3, "asc"]]
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