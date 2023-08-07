/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/scss/frontend/product.scss":
/*!**********************************************!*\
  !*** ./resources/scss/frontend/product.scss ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/frontend/product/productDetail.scss":
/*!************************************************************!*\
  !*** ./resources/scss/frontend/product/productDetail.scss ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/frontend/type.scss":
/*!*******************************************!*\
  !*** ./resources/scss/frontend/type.scss ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/includes/filter.scss":
/*!*********************************************!*\
  !*** ./resources/scss/includes/filter.scss ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/ui/footer.scss":
/*!***************************************!*\
  !*** ./resources/scss/ui/footer.scss ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/ui/sidebar.scss":
/*!****************************************!*\
  !*** ./resources/scss/ui/sidebar.scss ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/backend/admin/editProduct.scss":
/*!*******************************************************!*\
  !*** ./resources/scss/backend/admin/editProduct.scss ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/backend/admin/newProduct.scss":
/*!******************************************************!*\
  !*** ./resources/scss/backend/admin/newProduct.scss ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/backend/admin/viewOrder.scss":
/*!*****************************************************!*\
  !*** ./resources/scss/backend/admin/viewOrder.scss ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/frontend/contact.scss":
/*!**********************************************!*\
  !*** ./resources/scss/frontend/contact.scss ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/frontend/includes/productList.scss":
/*!***********************************************************!*\
  !*** ./resources/scss/frontend/includes/productList.scss ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/js/backend/admin/editProduct.js":
/*!***************************************************!*\
  !*** ./resources/js/backend/admin/editProduct.js ***!
  \***************************************************/
/***/ (() => {

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var table = new DataTable('#myTable', {
  // options
});

/**
 * initialization Event Listener after window load finish
 * @method init()
 */

window.onload = function init() {
  new EventListener('.paginate_button ', 'click', 'true', refreshWindows);
  new EventListener('.sorting  ', 'click', 'true', refreshWindows);
  new EventListener('#data-row', 'click', 'true', selectProducts);
  new EventListener('#data-row', 'dblclick', 'true', getData);

  // Form event
  new EventListener('#deleteButton', 'click', 'false', deleteProduct);
  new EventListener('#addNameButton', 'click', 'false', addNameList);
  new EventListener('#addBrandButton', 'click', 'false', addBrandList);
  alertOnload();
};

/**
 * Register function in this above
 */

// #region

function alertOnload() {
  var alertForm = document.querySelector('#alertForm');
  var bsAlert = new bootstrap.Alert(alertForm);
  setTimeout(function () {
    bsAlert.close();
  }, 3000);
}

/**
 * refresh another page
 * 
 */

function refreshWindows() {
  console.log('set');
  new EventListener('#data-row', 'click', 'true', selectProducts);
  new EventListener('#data-row', 'dblclick', 'true', getData);
}

/**
 * getData from row then select
 * 
 */

function getDataValue(selector) {
  return this.querySelector(selector).innerText;
}
function editProductForm(data) {
  var modal = new bootstrap.Modal(document.querySelector('#editProductForm'));
  console.log(data.productBrand);
  modal.show();
  document.querySelector('[name="productID"]').value = data.productID;
  // document.querySelector('[name="productName"]').value = data.productName;
  // document.querySelector('[name="productBrand"]').value = data.productBrand;

  function selectElement(id, valueToSelect) {
    var element = document.getElementById(id);
    element.value = valueToSelect;
  }
  selectElement('productCatelogList', data.productCatelog);
  selectElement('productTypeList', data.productType);
  selectElement('productStatusList', data.productStatus);

  /**
   *  reset
   */

  var containerBrand = document.querySelectorAll('#productBrandListContainer');
  if (containerBrand) {
    for (i = 0; i < containerBrand.length; i++) {
      containerBrand[i].remove();
    }
  }
  var containerName = document.querySelectorAll('#productNameListContainer');
  if (containerName) {
    for (i = 0; i < containerName.length; i++) {
      containerName[i].remove();
    }
  }
  console.log('进入Name');
  createNameList(data);
  console.log('进入Brand');
  createBrandList(data);
  console.log('结束');
}
function getData() {
  var productID = getDataValue.call(this, 'td[data-type="productID"]');
  var productName = getDataValue.call(this, 'td[data-type="productName"]');
  var productBrand = getDataValue.call(this, 'td[data-type="productBrand"]');
  var productCatelog = getDataValue.call(this, 'td[data-type="productCatelog"]');
  var productType = getDataValue.call(this, 'td[data-type="productType"]');
  var productStatus = getDataValue.call(this, 'div[data-type="productStatus"]');
  var productNameList = getDataValue.call(this, 'td[data-type="productNameList"]');
  var productBrandList = getDataValue.call(this, 'td[data-type="productBrandList"]');

  // Pack the rowData
  var data = {
    productID: productID,
    productName: productName,
    productBrand: productBrand,
    productCatelog: productCatelog,
    productType: productType,
    productStatus: productStatus,
    productNameList: productNameList,
    productBrandList: productBrandList
  };

  // Realization bootstrap 5 form
  editProductForm(data);
}

/**
 * Multichoice Operation
 * @param {Array} productSelectList the product are select
 */

var productSelectList = [];
function selectProducts() {
  var selectProduct = this;
  var isChecked = this.querySelector('input[type="checkbox"]').checked;
  if (isChecked) {
    selectProduct.querySelector('input[type="checkbox"]').checked = false;
    var targetProductId = this.getAttribute('data-product-id');
    productSelectList = productSelectList.filter(function (row) {
      return row["selectProductID"] !== targetProductId;
    });
  } else {
    selectProduct.querySelector('input[type="checkbox"]').checked = true;
    var selectProductID = this.getAttribute('data-product-id');
    var selectProductArray = {};
    selectProductArray = {
      selectProduct: selectProduct,
      selectProductID: selectProductID
    };
    productSelectList.push(selectProductArray);
  }
  ;
}

// #endregion

/**
 *  @param {Class} EventListener
 */

// #region
var EventListener = /*#__PURE__*/_createClass(
/**
 * @param {string} element What element what be listen?
 * @param {string} trigger How the element trigger?
 * @param {boolean} isSelectedAll Is lots of element want to be listen?
 * @param {function} callFunctionName If element trigger call where function?
 */

function EventListener(element, trigger, isSelectedAll, callFunctionName) {
  _classCallCheck(this, EventListener);
  _defineProperty(this, "element", void 0);
  _defineProperty(this, "trigger", void 0);
  _defineProperty(this, "isSelectedAll", void 0);
  _defineProperty(this, "callFunctionName", void 0);
  var elementWillListen = document.querySelectorAll(element);
  if (typeof callFunctionName !== 'function') {
    console.error('Invalid function name provided!');
    return;
  }
  if (isSelectedAll === 'true') {
    for (i = 0; i < elementWillListen.length; i++) {
      elementWillListen[i].addEventListener(trigger, callFunctionName);
    }
  } else {
    elementWillListen[0].addEventListener(trigger, callFunctionName);
  }
}); // #endregion
function getEmail() {
  var name = 'email=';
  var ca = document.cookie.split(';');
  console.log(ca);
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i].trim();
    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  }
}

/**
 * Updata product information
 * @param {string} email The record who edit
 */

function updataInformation() {
  var encodedEmail = decodeURIComponent(getEmail());
  console.log(encodedEmail);
}

/**
 * Form Event
 */

function deleteProduct() {
  var productID = document.querySelector('[name="productID"]').value;
  $.ajax({
    type: 'post',
    dataType: 'json',
    data: {
      'productID': productID
    },
    url: '/api/delete-product',
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
}

/**
 * create element or add new column
 */

function createNameList(data) {
  var dataArrayName = JSON.parse(data['productNameList']);
  var formName = document.querySelector('#productNameListRepeat');
  dataArrayName.forEach(function (record, index) {
    // Container
    var container = document.createElement('div');
    container.id = 'productNameListContainer';
    container.classList.add('display-row', 'mb-3');

    //创建car input元素
    var nameInput = document.createElement('input');
    nameInput.type = 'text';
    nameInput.classList.add('form-control', 'text');
    nameInput.name = "productNameList-CarModel[]";
    nameInput.value = record;
    nameInput.required = false;
    nameInput.placeholder = 'Product Name';
    if (index == 0) {
      nameInput.required = true;
    }
    container.appendChild(nameInput);
    formName.appendChild(container);
  });
}
function createBrandList(data) {
  var dataArrayBrand = JSON.parse(data['productBrandList']);
  var formBrand = document.querySelector('#productBrandListRepeat');
  dataArrayBrand.forEach(function (record, index) {
    // Container
    var container = document.createElement('div');
    container.id = 'productBrandListContainer';
    container.classList.add('display-row', 'mb-3');

    // 创建code input元素
    var codeInput = document.createElement('input');
    codeInput.type = 'text';
    codeInput.className = 'form-control';
    codeInput.name = "productBrandList-Code[]";
    // codeInput.name = `productBrand-Code[${index}]`;
    codeInput.value = record.code || '';
    codeInput.required = false;
    codeInput.placeholder = 'Code';
    if (index == 0) {
      codeInput.required = true;
    }

    // 创建brand input元素
    var brandInput = document.createElement('input');
    brandInput.type = 'text';
    brandInput.className = 'form-control';
    brandInput.name = "productBrandList-Brand[]";
    // brandInput.name = `productBrand-Brand[${index}]`;
    brandInput.value = record.brand || '';
    brandInput.required = false;
    brandInput.placeholder = 'Brand';
    if (index == 0) {
      brandInput.required = true;
    }

    // 创建fzcode input元素
    var fzcodeInput = document.createElement('input');
    fzcodeInput.type = 'text';
    fzcodeInput.className = 'form-control';
    fzcodeInput.name = "productBrandList-FZcode[]";
    // fzcodeInput.name = `productBrand-FZCode[${index}]`;
    fzcodeInput.value = record.fzcode || ''; // 如果fzcode为null，则设置为空字符串
    fzcodeInput.required = false;
    fzcodeInput.placeholder = 'FZ Code';
    if (index == 0) {
      fzcodeInput.required = true;
    }

    // 将创建的input元素添加到表单中
    container.appendChild(codeInput);
    container.appendChild(brandInput);
    container.appendChild(fzcodeInput);
    formBrand.appendChild(container);
  });
}
function addNameList() {
  var formName = document.querySelector('#productNameListRepeat');

  // Container
  var container = document.createElement('div');
  container.id = 'productNameListContainer';
  container.classList.add('display-row', 'mb-3');

  //创建car input元素
  var nameInput = document.createElement('input');
  nameInput.type = 'text';
  nameInput.classList.add('form-control', 'text');
  nameInput.name = "productNameList-CarModel[]";
  nameInput.required = false;
  nameInput.placeholder = 'Product Name';
  container.appendChild(nameInput);
  formName.appendChild(container);
}
function addBrandList() {
  var formBrand = document.querySelector('#productBrandListRepeat');

  // Container
  var container = document.createElement('div');
  container.id = 'productBrandListContainer';
  container.classList.add('display-row', 'mb-3');

  // 创建code input元素
  var codeInput = document.createElement('input');
  codeInput.type = 'text';
  codeInput.className = 'form-control';
  codeInput.name = "productBrandList-Code[]";
  codeInput.required = false;
  codeInput.placeholder = 'Code';

  // 创建brand input元素
  var brandInput = document.createElement('input');
  brandInput.type = 'text';
  brandInput.className = 'form-control';
  brandInput.name = "productBrandList-Brand[]";
  brandInput.required = false;
  brandInput.placeholder = 'Brand';

  // 创建fzcode input元素
  var fzcodeInput = document.createElement('input');
  fzcodeInput.type = 'text';
  fzcodeInput.className = 'form-control';
  fzcodeInput.name = "productBrandList-FZcode[]";
  fzcodeInput.required = false;
  fzcodeInput.placeholder = 'FZ Code';

  // 将创建的input元素添加到表单中
  container.appendChild(codeInput);
  container.appendChild(brandInput);
  container.appendChild(fzcodeInput);
  formBrand.appendChild(container);
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
/******/ 			"/js/backend/admin/editProduct": 0,
/******/ 			"css/frontend/includes/productList": 0,
/******/ 			"css/frontend/contact": 0,
/******/ 			"css/backend/admin/viewOrder": 0,
/******/ 			"css/backend/admin/newProduct": 0,
/******/ 			"css/backend/admin/editProduct": 0,
/******/ 			"css/ui/sidebar": 0,
/******/ 			"css/ui/footer": 0,
/******/ 			"css/includes/filter": 0,
/******/ 			"css/frontend/type": 0,
/******/ 			"css/frontend/product/productDetail": 0,
/******/ 			"css/frontend/product": 0
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
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/js/backend/admin/editProduct.js")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/backend/admin/editProduct.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/backend/admin/newProduct.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/backend/admin/viewOrder.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/frontend/contact.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/frontend/includes/productList.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/frontend/product.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/frontend/product/productDetail.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/frontend/type.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/includes/filter.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/ui/footer.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/frontend/includes/productList","css/frontend/contact","css/backend/admin/viewOrder","css/backend/admin/newProduct","css/backend/admin/editProduct","css/ui/sidebar","css/ui/footer","css/includes/filter","css/frontend/type","css/frontend/product/productDetail","css/frontend/product"], () => (__webpack_require__("./resources/scss/ui/sidebar.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;