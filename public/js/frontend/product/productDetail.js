/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./resources/js/frontend/product/productDetail.js ***!
  \********************************************************/
/**
 *  @method Image-preview
 * 
 */
var imageHover = document.querySelectorAll('img.product-image-hoverable');
var imageDisplay = document.querySelector('img.product-image-display');
var _loop = function _loop(_i) {
  imageHover[_i].addEventListener('mouseenter', function () {
    imageDisplay.src = imageHover[_i].src;
    imageHover[_i].classList.add('hover');
    for (var j = 0; j < imageHover.length; j++) {
      if (j !== _i) {
        imageHover[j].classList.remove('hover');
      }
    }
  });
};
for (var _i = 0; _i < imageHover.length; _i++) {
  _loop(_i);
}
var productBrand = document.querySelectorAll('.product-brand');
var _loop2 = function _loop2(l) {
  productBrand[l].addEventListener('click', function () {
    var category = productBrand[l].getAttribute('data-category');
    var id = productBrand[l].getAttribute('data-id');
    var brand = productBrand[l].getAttribute('data-brand');
    imageDisplay.src = "http://192.168.68.104/storage/".concat(category, "/").concat(id, "/").concat(brand, "/brand.png");
  });
};
for (var l = 0; l < productBrand.length; l++) {
  _loop2(l);
}

/**
 * Double click zoom image
 * @method zoom-image
 */

$('img').dblclick(function (event) {
  var src = this.src;
  console.log(src);
  $('#dbl-click-display').attr('src', src); // 設置圖片的src屬性
  $('.background').show();
});
$('#dbl-click-display').click(function (event) {
  return false;
});
$('.background').click(function (event) {
  $(this).hide(); // 使用$(this)來隱藏背景
});

/**
 *  @method Scroll-to-X
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

/**
 *  @method Add-to-cart
 */

var buttonRemoveQuantity = document.querySelector('#removeQuantity');
var buttonAddQuantity = document.querySelector('#addQuantity');
var currentQuantity = document.querySelector('#currentQuantity');
function getCurrentQuantity() {
  return parseInt(currentQuantity.innerText);
}
function modifiedQuantity(method) {
  var current = getCurrentQuantity();
  switch (method) {
    case 'add':
      currentQuantity.innerText = current + 1;
      break;
    case 'remove':
      currentQuantity.innerText = current - 1;
      break;
  }
}
buttonRemoveQuantity.addEventListener('click', function () {
  if (getCurrentQuantity() > 1) {
    modifiedQuantity('remove');
  }
});
buttonAddQuantity.addEventListener('click', function () {
  modifiedQuantity('add');
});

/**
 * @method Send-data-to-backend
 */

var addToCart = document.querySelector('#addToCart');
function getproductID() {
  var currentPath = window.location.pathname;
  var paramValue = currentPath.split('/').pop();
  return paramValue;
}
function getOption() {
  var option = document.getElementsByName('brand');
  for (i = 0; i < option.length; i++) {
    if (option[i].checked) {
      return option[i].value;
    }
  }
}
function getQuantity() {
  return parseInt(document.querySelector('#currentQuantity').innerText);
}
function getEmail() {
  var name = 'email_address=';
  var ca = document.cookie.split(';');
  console.log(ca);
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i].trim();
    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  }
}
function sendData(option, quantity, productID, email) {
  $.ajax({
    type: 'post',
    url: "/api/user/add-to-cart",
    data: JSON.stringify({
      "product_code": productID,
      "brand_code": option,
      "quantity": quantity,
      "email": email
    }),
    contentType: "application/json;charset=utf-8",
    success: function success(response) {
      notification.autoShow(2000);
      setTimeout(function () {
        if (response.redirect) {
          window.location.href = response.redirect;
        } else {
          location.reload();
        }
      }, 3500);
    },
    error: function error(XMLHttpRequest, textStatus, errorThrown) {
      console.log(XMLHttpRequest.status);
      console.log(XMLHttpRequest.readyState);
      console.log(textStatus);
      // location.reload();
    }
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    }
  });
}
addToCart.addEventListener('click', function () {
  var option = getOption();
  var quantity = getQuantity();
  var productID = getproductID();
  var encodedEmail = decodeURIComponent(getEmail());
  if (option !== undefined) {
    sendData(option, quantity, productID, encodedEmail);
  }
});
/******/ })()
;