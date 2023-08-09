/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/backend/user/cart/cart.js ***!
  \************************************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/** ———————————————————————————————————— object —————————————————————————————————————————— */
// #region
/**
 * @param {Object} CartCard - A unit who display the product with card
 */
var CartCard = /*#__PURE__*/function () {
  function CartCard(element) {
    _classCallCheck(this, CartCard);
    _defineProperty(this, "product_id", void 0);
    _defineProperty(this, "product_quantity", void 0);
    _defineProperty(this, "product_brand", void 0);
    _defineProperty(this, "element", void 0);
    _defineProperty(this, "cart_id", void 0);
    this.element = element;
    this.product_id = element.getAttribute('data-product-id');
    this.product_quantity = parseInt(element.getAttribute('data-quantity'));
    this.product_brand = element.getAttribute('data-brand');
    this.cart_id = element.getAttribute('data-cart');
    this.structureInit(element);
  }
  _createClass(CartCard, [{
    key: "structureInit",
    value: function structureInit(element) {
      /** control quantity button  */
      var removeQuantityButtonIcon = document.createElement('i');
      removeQuantityButtonIcon.classList.add('fa-solid', 'fa-minus');
      var removeQuantityButton = document.createElement('button');
      removeQuantityButton.type = 'button';
      removeQuantityButton.id = 'removeQuantityButton';
      removeQuantityButton.classList.add('quantity-button', 'remove');
      removeQuantityButton.appendChild(removeQuantityButtonIcon);
      var displayQuantity = document.createElement('div');
      displayQuantity.id = 'displayQuantityContainer';
      displayQuantity.classList.add('display-quantity');
      displayQuantity.innerText = this.product_quantity;
      var addQuantityButtonIcon = document.createElement('i');
      addQuantityButtonIcon.classList.add('fa-solid', 'fa-plus');
      var addQuantityButton = document.createElement('button');
      addQuantityButton.type = 'button';
      addQuantityButton.id = 'addQuantityButton';
      addQuantityButton.classList.add('quantity-button', 'add');
      addQuantityButton.appendChild(addQuantityButtonIcon);
      var footer = element.querySelector('[data-column="Quantity"]');
      footer.appendChild(removeQuantityButton);
      footer.appendChild(displayQuantity);
      footer.appendChild(addQuantityButton);
      this.eventListenerInit(removeQuantityButton, displayQuantity, addQuantityButton);
    }
  }, {
    key: "eventListenerInit",
    value: function eventListenerInit(removeQuantityButton, displayQuantity, addQuantityButton) {
      var _this = this;
      // remove quantity
      removeQuantityButton.addEventListener('click', function () {
        _this.removeQuantity(displayQuantity);
      });

      // add quantity
      addQuantityButton.addEventListener('click', function () {
        _this.addQuantity(displayQuantity);
      });
    }
  }, {
    key: "removeQuantity",
    value: function removeQuantity(displayQuantity) {
      var product_quantity = parseInt(displayQuantity.innerText);
      if (product_quantity === 0) {
        return;
      }
      product_quantity -= 1;
      this.refreshQuantity(displayQuantity, product_quantity);
    }
  }, {
    key: "addQuantity",
    value: function addQuantity(displayQuantity) {
      var product_quantity = parseInt(displayQuantity.innerText);
      product_quantity += 1;
      this.refreshQuantity(displayQuantity, product_quantity);
    }
  }, {
    key: "refreshQuantity",
    value: function refreshQuantity(displayQuantity, product_quantity) {
      displayQuantity.innerText = product_quantity;
      this.element.setAttribute('data-quantity', product_quantity);
      this.product_quantity = product_quantity;
      this.updateQuantity(this.product_brand);
    }
  }, {
    key: "updateQuantity",
    value: function updateQuantity() {
      $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
          'ID': this.cart_id,
          'productID': this.product_id,
          'productBrand': this.product_brand,
          'quantity': this.product_quantity
        },
        url: '/api/update-cart-quantity',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function success(data) {
          console.log(data);
        },
        error: function error(xhr, status, _error) {
          console.log('AJAX Error:', xhr, status, _error);
        }
      });
    }
  }]);
  return CartCard;
}(); // #endregion
/** ———————————————————————————————————— function —————————————————————————————————————————— */
/**
 * generator order with select products
 * 
 */
// #region
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
      error: function error(xhr, status, _error2) {
        console.error("Server status: ".concat(status, "\nError: ").concat(_error2));
      }
    });
  } catch (error) {
    console.error(error);
  }
}

// #endregion

/** ———————————————————————————————————— initialization —————————————————————————————————————————— */

// #region 

function initialization() {
  // 將 class="product-card" 的dom元素注冊成 CartCard 實例
  var cards = document.querySelectorAll('.product-card');
  var productCardInstances = [];
  for (var _i = 0; _i < cards.length; _i++) {
    var cardInstance = new CartCard(cards[_i]);
    productCardInstances.push(cardInstance);
  }
}
initialization();

// #endregion

/** ———————————————————————————————————— event listener —————————————————————————————————————————— */

// #region 

/**  */

var checkOrder = document.querySelector('#checkOrder');
checkOrder.addEventListener('click', checkOrderForm);
function checkOrderForm() {}
function generate() {}

// #endregion

/** ————————————————————————————— Data Table ————————————————————————————— */

var table = new DataTable('#myTable', {});
$(document).ready(function () {
  // 监听点击事件，选择特定的 <tr> 元素
  $('tr.product-card').click(function (event) {
    $('button.quantity-button').click(function (event) {
      // 阻止事件冒泡，避免触发父元素的点击事件，包括 checkbox 的点击事件
      event.stopPropagation();
      // 在这里添加你希望按钮点击后执行的代码
    });

    $('.checkbox').click(function (event) {
      // 阻止事件冒泡，避免触发父元素的点击事件
      event.stopPropagation();
    });

    // 获取被点击的 <tr> 元素内部的 checkbox
    var checkbox = $(this).find('.checkbox');

    // 切换 checkbox 的选中状态
    checkbox.prop('checked', !checkbox.prop('checked'));
  });
  $('#selectAll').click(function (event) {
    // 阻止事件冒泡，避免触发父元素的点击事件
    event.stopPropagation();

    // 获取全选按钮的状态
    var selectAllChecked = $(this).prop('checked');

    // 将所有具有 .checkbox 类的复选框的状态设置为与全选按钮相同
    $('.checkbox').prop('checked', selectAllChecked);
  });
});
/******/ })()
;