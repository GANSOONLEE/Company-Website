/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./resources/js/backend/user/order/orderDetail.js ***!
  \********************************************************/
/* ———————————————————— clipboard ———————————————————— */

var clipBoardButton = document.querySelectorAll('[data-action="clipboard"]');
for (var i = 0; i < clipBoardButton.length; i++) {
  clipBoardButton[i].addEventListener('click', function (event) {
    navigator.clipboard.writeText(event.target.innerText).then(function () {
      console.log(event.target.innerText);
    })["catch"](function (error) {
      console.error('Clipboard write error:', error);
    });
    var clipboardNotice = document.querySelector('.clipboard');
    clipboardNotice.classList.remove('hidden');
    clipboardNotice.classList.add('show');
    setTimeout(function () {
      clipboardNotice.classList.remove('show');
      clipboardNotice.classList.add('hidden');
    }, 2500);
  });
}
/******/ })()
;