/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************************!*\
  !*** ./resources/js/backend/admin/managementUser.js ***!
  \******************************************************/
var table = new DataTable('#myTable', {
  "order": [[3, "desc"]]
});
$(document).ready(function () {
  $('.restoreButton').click(function (event) {
    var id = event.target.id;
    var operationID = $(event.currentTarget).data('operation-id');
    $.ajax({
      url: '/api/restore-record',
      data: {
        'id': id,
        'operationID': operationID
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
        location.reload();
      }
    });
  });
});
/******/ })()
;