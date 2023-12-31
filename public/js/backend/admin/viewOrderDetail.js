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
      'orderID': orderID,
      'status': 'complete'
    },
    dataType: 'json',
    type: 'post',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(data) {
      location.reload();
    },
    error: function error(xhr, status, _error) {
      console.error(xhr, status, _error);
      location.reload();
    }
  });
});

// $('#OnHoldButton').click(function(event){
//     let orderID = $(this).data('order-id');
//     $.ajax({
//         url: '/api/update-order-status',
//         data: {'orderID': orderID, 'status' : 'on hold'},
//         dataType: 'json',
//         type: 'post',
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function(data) {
//             // console.log(data)
//             location.reload();
//         },
//         error: function(xhr, status, error) {
//             // console.error(xhr,status,error)
//             location.reload();
//         }
//     });
// });

// $('#InProcessButton').click(function(event){
//     let orderID = $(this).data('order-id');
//     $.ajax({
//         url: '/api/update-order-status',
//         data: {'orderID': orderID, 'status' : 'processing'},
//         dataType: 'json',
//         type: 'post',
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function(data) {
//             location.reload();
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr,status,error)
//             location.reload();
//         }
//     });
// });

/* ———————————————————— Update own ———————————————————— */

$('#updateProductOwn').click(function (event) {
  var orderID = $('#orderID').text();
  var quantity = $('#editModal #quantity').val();
  var own = $('#editModal #own').val();
  var brand = $('#brand').val();
  if (own > quantity) {
    return false;
  }
  console.log(orderID, own, brand, quantity);
  $.ajax({
    url: '/api/update-cart-own',
    data: {
      'orderID': orderID,
      'own': own,
      'brand': brand
    },
    dataType: 'json',
    type: 'post',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(data) {
      // console.log(data)
      location.reload();
    },
    error: function error(xhr, status, _error2) {
      // console.error(xhr,status,error)
      location.reload();
    }
  });
});

/* —————————————————————— Creating forms with data —————————————————————— */

$('.view').click(function (event) {
  event.stopPropagation();
});
$('.order-list').click(function () {
  var quantity = $(this).find('p[data="quantity"]').text();
  var index = $(this).find('p[data="index"]').text();
  var cartID = $(this).find('p[data="cartID"]').text();
  var category = $(this).find('p[data="category"]').text();
  var name = $(this).find('p[data="name"]').text();
  var brand = $(this).find('p[data="brand"]').text();
  var own = $(this).find('p[data="own"]').text();
  $('#editModal').click(function (event) {
    event.stopPropagation();
  });
  $('#editModal #index').empty();
  $('#editModal #own').val('');
  $('#editModal #index').text(index);
  $('#editModal #cartID').text(cartID);
  $('#editModal #category').val(category);
  $('#editModal #name').val(name);
  $('#editModal #quantity').val(quantity);
  $('#editModal #own').val(own);
  $('#editModal #brand').val(brand);

  // 显示模态框
  $('#backgroundModal').show();
});

// Close the modal
$('#backgroundModalButton').click(function () {
  $('#backgroundModal').hide();
});

// Animation
$('#backgroundModal').click(function () {
  $('#editModal').addClass('shake');
  setTimeout(function () {
    $('#editModal').removeClass('shake');
  }, 2000);
});
/******/ })()
;