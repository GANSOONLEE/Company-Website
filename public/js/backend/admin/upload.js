/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/backend/admin/upload.js ***!
  \**********************************************/
/**
 *  Upload image
 *  @method droptarget // events fired on the drop targets
 *  @method dragenter // when the draggable element enters it
 *  @method dragleave // when the draggable element leaves it
 *  @method drop // prevent default action
 * 
 *  @url https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/drag_event
 * 
 *  @param imageThumble // this area are prepared to where image upload display their thumbnail
 *  @param imageInput // this area are the drag and drop valid area
 */

var imageThumble = document.querySelector('#images-thumble');
var imageInput = document.querySelector('#image-input');

/**
 *  Add event-listener to the element we want
 *  @static
 */

// prevent default action (open file explorer)
function drop() {}

/**
 *  @method previousButton():void
 *  @method nextButton():void
 *   
 */

var scrollXList = document.querySelector('#images-thumble');

/**
 *  @method helperFunction
 */

function getScrollX() {
  // Number
  return scrollXList.scrollLeft;
}
function getWidth() {
  // Number
  return scrollXList.offsetWidth;
}
function displacement() {
  var X = getWidth() / 2;
  return X;
}

/**
 *  @param object
 */

var previousButton = document.querySelector('#previousButton');
var nextButton = document.querySelector('#nextButton');

// previousButton.addEventListener('click', moveScrollX('previous'));
// previousButton.addEventListener('click', moveScrollX('next'));
/******/ })()
;