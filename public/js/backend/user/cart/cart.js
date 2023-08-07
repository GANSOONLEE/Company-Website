/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/backend/user/cart/cart.js ***!
  \************************************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/** ———————————————————————————————————— object —————————————————————————————————————————— */
// #region
/**
 * @param {Object} CartCard - A unit who display the product with card
 */
var CartCard = /*#__PURE__*/_createClass(function CartCard() {
  _classCallCheck(this, CartCard);
  _defineProperty(this, "product_id", void 0);
  _defineProperty(this, "product_quantity", void 0);
  _defineProperty(this, "product_brand", void 0);
  product_id = this.getAttributes('data-product-id');
  product_quantity = this.getAttributes('data-quantity');
  product_brand = this.getAttributes('data-brand');
}); // #endregion
/** ———————————————————————————————————— function —————————————————————————————————————————— */
/**
 * generator order with select products
 * 
 */
function createOrder() {
  /** @param {Array} selectProduct </br>The set of the select product, sort with category A-Z */
  var selectProduct = document.querySelectorAll('input[type="checkbox"]');

  /** have any product selected? */
  if (!selectProduct || selectProduct.length === 0) {
    console.log('Can\'t found any product selected');
    return;
  }
  try {
    var orderElement = [];
    for (i = 0; i < selectProduct.length; i++) {
      var data = [{
        'productID': selectProduct[i].product_id,
        'productQuantity': selectProduct[i].product_quantity,
        'productBrand': selectProduct[i].product_brand
      }];
      orderElement = data;
      console.log(selectProduct[i]);
      console.log(data);
    }
    generatedOrder(orderElement);
    console.info(orderElement);
  } catch (error) {
    console.error("Error: ".concat(error));
  }
}

/**
 * follow the info to generate order and send it
 * 
 */

function generatedOrder(orderElement) {
  try {
    // get the csrfToken
    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // send order inform to backend
    // #TODO send order inform to backend
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: orderElement,
      url: '/api/generate-order',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function success(data) {
        console.log(data);
      },
      error: function error(xhr, status, _error) {
        console.error("Server status: ".concat(status, "\nError: ").concat(_error));
      }
    });
  } catch (error) {
    console.error(error);
  }
}

/** ———————————————————————————————————— initialization —————————————————————————————————————————— */

// #region 

window.onload = function initialization() {
  // 將 class="product-card" 的dom元素注冊成 CartCard 實例
  var card = document.querySelectorAll('.product-card');
  var productCardInstances = [];
  for (i = 0; i < card.length; i++) {
    var cardInstance = new CartCard(cards[i]);
    productCardInstances.push(cardInstance);
  }
  console.log(productCardInstances);
};

// #endregion

/** ———————————————————————————————————— event listener —————————————————————————————————————————— */

// #region 

// #endregion
/******/ })()
;