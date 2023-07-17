
/**
 *  @method Image-preview
 * 
 */
var imageHover = document.querySelectorAll('img.product-image-hoverable');
var imageDisplay = document.querySelector('img.product-image-display');

for(let i = 0; i < imageHover.length; i++){
    imageHover[i].addEventListener('mouseenter', ()=>{
        imageDisplay.src = imageHover[i].src;
        imageHover[i].classList.add('hover');
        for (let j = 0; j < imageHover.length; j++) {
            if (j !== i) {
                imageHover[j].classList.remove('hover');
            }
        }
    })
}

/**
 *  @method Scroll-to-X
 *  
 */

var prevousButton = document.querySelector('.prevous-image');
var imageSelector = document.querySelector('.image-selector-area');
var nextButton = document.querySelector('.next-image');
var moveDistance = (imageSelector.clientWidth / 1);

function getScrollX(){
    let scrollX = imageSelector.scrollLeft;
    return scrollX
}

prevousButton.addEventListener('click', ()=>{
    console.log('prevous')
    let scrollX = getScrollX()
    imageSelector.scrollTo(scrollX - moveDistance, 0);
})

nextButton.addEventListener('click', ()=>{
    console.log('next')
    let scrollX = getScrollX()
    imageSelector.scrollTo(scrollX + moveDistance, 0);
})

imageSelector.scrollIntoView({
    behavior: 'smooth',
})

/**
 *  @method Add-to-cart
 */

let buttonRemoveQuantity =  document.querySelector('#removeQuantity');
let buttonAddQuantity =  document.querySelector('#addQuantity');

let currentQuantity = document.querySelector('#currentQuantity');

function getCurrentQuantity(){
    return parseInt(currentQuantity.innerText);
}

function modifiedQuantity(method){
    let current = getCurrentQuantity();
    switch(method){
        case 'add':
            currentQuantity.innerText = current + 1;
            break;
        case 'remove':
            currentQuantity.innerText = current - 1;
            break;
    }
}

buttonRemoveQuantity.addEventListener('click', ()=>{
    if(getCurrentQuantity() > 1){
        modifiedQuantity('remove');
    }
})

buttonAddQuantity.addEventListener('click', ()=>{
    modifiedQuantity('add');
})

/**
 * @method Send-data-to-backend
 */

let addToCart = document.querySelector('#addToCart');

function getProductCode(){
    var currentPath = window.location.pathname;
    var paramValue = currentPath.split('/').pop();
    return paramValue;
}

function getOption(){
    let option = document.getElementsByName('model');
    for(i=0; i < option.length; i++){
        if(option[i].checked){
            return option[i].value
        }
    }
}

function getQuantity(){
    return parseInt(document.querySelector('#currentQuantity').innerText)
}

function getEmail(){
    var name = 'email=';
    var ca = document.cookie.split(';');
    console.log(ca);
    for(var i=0; i<ca.length; i++){
        var c = ca[i].trim();
        if (c.indexOf(name)==0) return c.substring(name.length,c.length);
    }
    
}

function sendData(option, quantity, productCode, email){
    $.ajax({
        type: 'post',
        url: `/api/user/add-to-cart`,
        data: JSON.stringify({
            "productCode": productCode,
            "productBrand": option,
            "quantity": quantity,
            "email": email
        }),
        contentType : "application/json;charset=utf-8",
        success: function(data){
            console.log('Successful!');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest.status);
            console.log(XMLHttpRequest.readyState);
            console.log(textStatus);
        }
    })
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
}

addToCart.addEventListener('click', ()=>{
    let option = getOption();
    let quantity = getQuantity();
    let productCode = getProductCode();
    let encodedEmail = urldecode(getEmail())
    console.log(encodedEmail)
    if(option !== undefined){
        sendData(option, quantity, productCode, encodedEmail)
    }
})

