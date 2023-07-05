/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/scss/backend/admin/newProductShopee.scss":
/*!************************************************************!*\
  !*** ./resources/scss/backend/admin/newProductShopee.scss ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/js/backend/admin/upload.js":
/*!**********************************************!*\
  !*** ./resources/js/backend/admin/upload.js ***!
  \**********************************************/
/***/ (() => {

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
var droptarget = document.getElementById('drop');
var dropImageList = document.getElementById('dropImageList');
var imageQuantity = document.querySelector('.count');
var uploadButton = document.querySelector('#uploadButton');
var fileArr = [];
var fileBlodArr = [];
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

// 拖拽事件绑定
droptarget.addEventListener('dragenter', handleEvent);
droptarget.addEventListener('dragover', handleEvent);
droptarget.addEventListener('drop', handleEvent);
droptarget.addEventListener('dragleave', handleEvent);
droptarget.addEventListener('click', function () {
  if (fileArr.length < 10) {
    var _uploadButton = document.getElementById('uploadButton');
    _uploadButton.click();
    droptarget.classList.remove('disable');
    document.querySelector('.note').innerText = "Add Image";
  } else {
    droptarget.classList.add('disable');
    document.querySelector('.note').innerText = "Max";
  }
});
var fileInput = document.getElementById('fileInput');
fileInput.addEventListener('change', function (event) {
  fileArr.push(event.target.files[0]);
  filesToBlod(event.target.files[0]);
});
function upload() {
  fileInput.addEventListener('click', handleEvent);
}
function filesToBlod(file) {
  if (fileArr.length > 10) {
    alert('Over limit');
  }
  var reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = function (e) {
    newFunction();
    function newFunction() {
      if (fileArr.length <= 10) {
        fileBlodArr.push(e.target.result);
        var fileDiv = document.createElement('div');
        fileDiv.id = 'drop-image-box';
        fileDiv.classList.add('drop-image-box');
        fileDiv.draggable = true; // 将元素设置为可拖拽

        // 文件名称
        var fileName = document.createElement('p');
        fileName.classList.add('drop-image-box-title');
        fileName.innerHTML = file.name;
        fileName.title = file.name;
        var deleteBtn = document.createElement('div');
        deleteBtn.classList.add('drop-image-delete');
        deleteBtn.innerText = 'Delete';

        // 顯示照片略縮圖
        var img = document.createElement('img');
        img.classList.add('thumble');
        img.draggable = true;
        img.src = e.target.result;
        fileDiv.appendChild(img);
        fileDiv.appendChild(deleteBtn);
        fileDiv.appendChild(fileName);
        dropImageList.appendChild(fileDiv);
        imageQuantity.innerText = '(' + fileArr.length + '/10)';
        deleteBtn.addEventListener('click', function () {
          deleteFile(file);
          dropImageList.removeChild(fileDiv);
          imageQuantity.innerText = '(' + fileArr.length + '/10)';
          droptarget.classList.remove('disable');
          document.querySelector('.note').innerText = "Add Image";
        });
      }
    }
  };
  reader.onerror = function () {
    switch (reader.error.code) {
      case '1':
        alert("Can't find the file");
      case '2':
        alert('Security Error!');
      case '3':
        alert('Read interrupted');
      case '4':
        alert("Can't read the file");
      case '5':
        alert('Read file failure');
    }
  };
}
function deleteFile(file) {
  var index = fileArr.indexOf(file);
  if (index > -1) {
    fileArr.splice(index, 1);
    fileBlodArr.splice(index, 1);
  }
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/backend/admin/upload": 0,
/******/ 			"css/backend/admin/newProductShopee": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/backend/admin/newProductShopee"], () => (__webpack_require__("./resources/js/backend/admin/upload.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/backend/admin/newProductShopee"], () => (__webpack_require__("./resources/scss/backend/admin/newProductShopee.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;