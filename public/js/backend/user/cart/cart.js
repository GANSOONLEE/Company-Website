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
    this.product_id = element.getAttribute('data-id');
    this.product_quantity = parseInt(element.getAttribute('data-quantity'));
    this.product_brand = element.getAttribute('data-brand');
    this.cart_id = element.getAttribute('data-cart-id');
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
      console.log(this.cart_id, this.product_id, this.product_brand, this.product_quantity);
      $.ajax({
        type: 'post',
        dataType: 'json',
        data: {
          'cartID': this.cart_id,
          'productID': this.product_id,
          'productBrand': this.product_brand,
          'quantity': this.product_quantity
        },
        url: '/api/update-cart-quantity',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function success(data) {
          // location.reload()
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
  try {
    var orderElement = [];
    for (i = 0; i < selectProduct.length; i++) {
      var data = [{
        'productID': selectProduct[i].product_id,
        'productQuantity': selectProduct[i].product_quantity,
        'productBrand': selectProduct[i].product_brand
      }];
      orderElement = data;
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
        // location.reload();
        // console.log(data)
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

/** ————————————————————————————— Data Table ————————————————————————————— */

var table = new DataTable('#myTable', {
  "order": [[1, "asc"], [2, "asc"], [3, "asc"]]
});
$(document).ready(function () {
  // 监听点击事件，选择特定的 <tr> 元素
  $('tr.product-card').click(function (event) {
    $('button.quantity-button').click(function (event) {
      event.stopPropagation();
    });
    $('.checkbox').click(function (event) {
      event.stopPropagation();
      $(this).closest('tr.product-card').click();
      // return false;
    });

    var checkbox = $(this).find('.checkbox');
    checkbox.prop('checked', !checkbox.prop('checked'));
    var allChecked = $('.checkbox:checked').length === $('.checkbox').length;
    $('#selectAll').prop('checked', allChecked);
  });
  $('#selectAll').click(function (event) {
    event.stopPropagation();
    var selectAllChecked = $(this).prop('checked');
    $('.checkbox').prop('checked', selectAllChecked);
  });
});

/* ———————————————————— Send Order ———————————————————— */

$(document).ready(function () {
  $('#generatingOrder').click(function (event) {
    generateData();
  });
});
function generateData() {
  var itemChecked;
  var selectedProductIds = [];
  var selectAllChecked = $('#selectAll').prop('checked');
  itemChecked = selectAllChecked ? itemChecked = $('.checkbox') : itemChecked = $('.checkbox:checked');

  /** have any product selected? */
  if (!itemChecked || itemChecked.length === 0) {
    confirm('Can\'t found any product selected');
    return;
  }
  itemChecked.each(function () {
    var id = this.parentNode.parentNode.getAttribute('data-id');
    var brand = this.parentNode.parentNode.getAttribute('data-brand');
    var quantity = this.parentNode.parentNode.getAttribute('data-quantity');
    if (quantity === '0') {
      confirm('Can\'n select item quantity are 0');
      throw new Error('Can\'n select item quantity 0');
      return false;
    }
    selectedProductIds.push({
      id: id,
      brand: brand,
      quantity: quantity
    });
  });
  var email = document.querySelector('#email').innerText;

  // 使用 AJAX 发送数据到指定的路由
  $.ajax({
    url: '/api/create-order',
    type: 'POST',
    data: {
      productIds: selectedProductIds,
      'email': email
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      // 处理响应
      location.reload();
      test.autoShow(5000);
      // confirm('Order have been create');
      // console.log(response);
    },

    error: function error(_error3) {
      // 处理错误
      console.error(_error3);
    }
  });
}

/* ———————————————————— Send Order ———————————————————— */

$(document).ready(function () {
  $('#checkOrder').click(function (event) {
    sendData();
  });
});
function sendData() {
  var itemChecked;
  var selectedProductIds = [];
  itemChecked = $('.checkbox:checked');

  /** have any product selected? */
  if (!itemChecked || itemChecked.length === 0) {
    confirm('Can\'t found any product selected');
    return;
  }

  // console.log(itemChecked)

  // 遍历选中的复选框，获取其 data-id 属性值
  itemChecked.each(function () {
    // let id = $(this).data('id');
    // let quantity = $(this).closest('tr').data('quantity');
    var id = this.parentNode.parentNode.getAttribute('data-id');
    var brand = this.parentNode.parentNode.getAttribute('data-brand');
    var quantity = this.parentNode.parentNode.getAttribute('data-quantity');
    if (quantity === '0') {
      confirm('Can\'n select item quantity are 0');
      throw new Error('Can\'n select item quantity 0');
      return false;
    }
    selectedProductIds.push({
      id: id,
      brand: brand,
      quantity: quantity
    });
  });
  var email = document.querySelector('#email').innerText;

  // 使用 AJAX 发送数据到指定的路由
  $.ajax({
    url: '/api/create-order',
    type: 'POST',
    data: {
      productIds: selectedProductIds,
      'email': email
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      notification.setUp('Thank you, we will process your order as soon as possible', 'fa-solid fa-circle-check', 3000);
      notification.autoShow(5000);
      setTimeout(function () {
        location.reload();
      }, 6500);
    },
    error: function error(_error4) {
      notification.setUp('Sorry! Something went wrong!', 'fa-solid fa-circle-xmark', 3000);
      notification.autoShow(5000);
      setTimeout(function () {
        // location.reload();
      }, 6500);
      // console.error(error);
    }
  });
}
/******/ })()
;