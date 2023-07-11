/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./resources/js/frontend/product/productDetail.js ***!
  \********************************************************/
var imageHover = document.querySelectorAll('img.product-image-hoverable');
var imageDisplay = document.querySelector('img.product-image-display');
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

/**
 *  @method scrollX
 *  
 */

var prevousButton = document.querySelector('.prevous-image');
var imageSelector = document.querySelector('.image-selector-area');
var nextButton = document.querySelector('.next-image');
var moveDistance = imageSelector.clientWidth / 1;
function getScrollX() {
  var scrollX = imageSelector.scrollLeft;
  return scrollX;
}
prevousButton.addEventListener('click', function () {
  console.log('prevous');
  var scrollX = getScrollX();
  imageSelector.scrollTo(scrollX - moveDistance, 0);
});
nextButton.addEventListener('click', function () {
  console.log('next');
  var scrollX = getScrollX();
  imageSelector.scrollTo(scrollX + moveDistance, 0);
});
imageSelector.scrollIntoView({
  behavior: 'smooth'
});
/******/ })()
;