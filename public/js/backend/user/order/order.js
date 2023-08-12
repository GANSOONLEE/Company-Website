/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/js/backend/user/order/order.js ***!
  \**************************************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/* ———————————————————— OrderCard::class ———————————————————— */
var OrderCard = /*#__PURE__*/function () {
  function OrderCard(cardElement) {
    var _this = this;
    _classCallCheck(this, OrderCard);
    _defineProperty(this, "cardElement", void 0);
    _defineProperty(this, "orderID", void 0);
    this.cardElement = cardElement;
    this.orderID = cardElement.querySelector('.order-id').innerText;
    $(this.cardElement).click(function (event) {
      _this.sendData(event.currentTarget);
    });
  }
  _createClass(OrderCard, [{
    key: "sendData",
    value: function sendData() {
      var self = this;
      $.ajax({
        url: '/api/user-view-order',
        type: 'post',
        data: {
          'orderID': this.orderID
        },
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function success(data) {
          console.log(data);
          self.updateStatus(data.order);
        },
        error: function error(xhr, status, _error) {
          console.log('AJAX Error:', xhr, status, _error);
        }
      });
    }
  }, {
    key: "updateStatus",
    value: function updateStatus(status) {
      $('#order-item-list').empty();

      // Define Variable
      var orderID = $('#orderID');
      var orderReceivedDate = $('#orderReceivedDate');
      var orderReceivedTime = $('#orderReceivedTime');
      var orderStatus = document.querySelector('#orderStatus');

      // Information Init
      orderID.text(status['orderID']);
      orderStatus.innerText = status['orderStatus'];
      var parsedOrderContent = JSON.parse(status['orderContent']);

      // 遍歷數組中的每個元素
      parsedOrderContent.forEach(function (item) {
        var orderUnit = document.createElement('div');
        orderUnit.classList.add('order');
        var itemInfo = document.createElement('div');
        itemInfo.classList.add('item-info');
        var itemID = document.createElement('p');
        itemID.classList.add('item-id');
        itemID.id = 'ItemID';
        itemID.innerText = item.id;
        var itemBrand = document.createElement('p');
        itemBrand.classList.add('item-brand');
        itemBrand.id = 'ItemBrand';
        itemBrand.innerText = item.brand;
        itemInfo.appendChild(itemID);
        itemInfo.appendChild(itemBrand);
        var itemQuantity = document.createElement('div');
        itemQuantity.classList.add('item-quantity');
        var ItemQuantity = document.createElement('p');
        ItemQuantity.id = 'ItemQuantity';
        ItemQuantity.innerText = item.quantity;
        itemQuantity.appendChild(ItemQuantity);
        orderUnit.appendChild(itemInfo);
        orderUnit.appendChild(itemQuantity);
        document.querySelector('#order-item-list').appendChild(orderUnit);
        document.querySelector('#orderModel').classList.add('show');
      });
    }
  }]);
  return OrderCard;
}();
/* —————————————————— Onload —————————————————— */
window.onload = function ready() {
  /* ———— Init Class ———— */
  var orderCards = document.querySelectorAll('.card');
  var orderCardInstanceArray = [];
  for (var i = 0; i < orderCards.length; i++) {
    var orderCardInstance = new OrderCard(orderCards[i]);
    orderCardInstanceArray.push(orderCardInstance);
  }

  /* Init Modal */
  $('#closeModalButton').click(function (event) {
    document.querySelector('#orderModel').classList.remove('show');
  });

  /* Close Modal */
  $('#orderModel').click(function (event) {
    event.target.classList.remove('show');
  });
};
/******/ })()
;