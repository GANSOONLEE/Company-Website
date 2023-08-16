/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************!*\
  !*** ./resources/js/backend/admin/viewOrderDetail.js ***!
  \*******************************************************/
/* ———————————————————— Update Order Status ———————————————————— */

$('#CompleteButton').click(function (event) {
  var orderID = $(this).data('order-id');
  $.ajax({
    url: '/api/update-order-status',
    data: {
      'orderID': orderID
    },
    dataType: 'json',
    type: 'post',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(data) {
      console.info(data);
      // location.reload();
    },

    error: function error(xhr, status, _error) {
      console.error(xhr, status, _error);
    }
  });
});

/* ——————————————————————  —————————————————————— */

$('.order-list').click(function () {
  var quantity = $(this).find('p[data="quantity"]').text();
  var index = $(this).find('p[data="index"]').text();
  var category = $(this).find('p[data="category"]').text();
  var name = $(this).find('p[data="name"]').text();
  var brand = $(this).find('p[data="brand"]').text();
  $('#editModal').click(function (event) {
    event.stopPropagation();
  });
  $('#editModal #index').empty();
  $('#editModal #index').text(index);
  $('#editModal #category').val(category);
  $('#editModal #name').val(name);
  $('#editModal #quantity').val(quantity);
  $('#editModal #brand').val(brand);

  // 显示模态框
  $('#backgroundModal').show();
});
$('#backgroundModalButton').click(function () {
  $('#backgroundModal').hide();
});
/******/ })()
;