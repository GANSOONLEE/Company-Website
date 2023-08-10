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
  var name = 'email=';
  var ca = document.cookie.split(';');
  console.log(ca);
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i].trim();
    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  }
}
function sendData(option, quantity, productID, email, productCategory) {
  $.ajax({
    type: 'post',
    url: "/api/user/add-to-cart",
    data: JSON.stringify({
      "productID": productID,
      "productBrand": option,
      "quantity": quantity,
      "email": email,
      'productCategory': productCategory
    }),
    contentType: "application/json;charset=utf-8",
    success: function success(Text) {
      // console.log(Text)
      location.reload();
    },
    error: function error(XMLHttpRequest, textStatus, errorThrown) {
      console.log(XMLHttpRequest.status);
      console.log(XMLHttpRequest.readyState);
      console.log(textStatus);
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
  var productCategory = document.querySelector('[name="productCategory"]').value;
  if (option !== undefined) {
    sendData(option, quantity, productID, encodedEmail, productCategory);
  }
});
/******/ })()
;