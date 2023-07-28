/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/backend/admin/upload.js ***!
  \**********************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
var droptarget = document.getElementById('drop');
var dropImageList = document.getElementById('dropImageList');
var imageQuantity = document.querySelector('.count');
var uploadButton = document.querySelector('#uploadButton');
var uploadImagesInput = document.querySelector('#imgUpload');
var fileArr = [];
var fileBlodArr = [];
var imagePaths = [];
uploadButton.addEventListener('change', function (event) {
  var files = event.target.files;

  // 遍历文件列表，将文件添加到 fileArr 数组中
  var _iterator = _createForOfIteratorHelper(files),
    _step;
  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var file = _step.value;
      if (fileArr.length < 10) {
        fileArr.push(file);
        filesToBlod(file);
        droptarget.classList.remove('disable');
        document.querySelector('.note').innerText = "Add Image";
      } else {
        droptarget.classList.add('disable');
        document.querySelector('.note').innerText = "Max";
      }
    }

    // 重置 input 元素的值，清空选择的文件
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
  event.target.value = '';
});
function handleEvent(event) {
  event.preventDefault();
  if (event.type === 'drop' || event.type === 'click') {
    droptarget.classList.remove('active');
    var _iterator2 = _createForOfIteratorHelper(event.dataTransfer.files),
      _step2;
    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var file = _step2.value;
        if (fileArr.length < 10) {
          fileArr.push(file);
          filesToBlod(file);
        }
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }
  } else if (event.type === 'dragleave') {
    droptarget.classList.remove('active');
  } else {
    droptarget.classList.add('active');
  }
}

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
previousButton.addEventListener('click', moveScrollX('previous'));
previousButton.addEventListener('click', moveScrollX('next'));
/******/ })()
;