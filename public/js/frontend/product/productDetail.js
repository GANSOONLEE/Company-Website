/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./resources/js/frontend/product/productDetail.js ***!
  \********************************************************/
var imageHover = document.querySelectorAll('.product-image-hoverable');
var imageDisplay = document.querySelector('.product-image-display');
var _loop = function _loop(i) {
  imageHover[i].addEventListener('mouseenter', function () {
    imageDisplay.src = imageHover[i].src;
    imageHover[i].classList.add('hover');
    for (var j = 0; j < imageHover.length; j++) {
      if (j !== i) {
        imageHover[j].classList.remove('hover');
      }
    }
  });
};
for (var i = 0; i < imageHover.length; i++) {
  _loop(i);
}
/******/ })()
;