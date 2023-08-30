
/**
 *  @method Image-preview
 * 
 */
let imageHover = document.querySelectorAll('img.product-image-hoverable');
let imageDisplay = document.querySelector('img.product-image-display');

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
 * Double click zoom image
 * @method zoom-image
 */

$('img').dblclick(function(event) {
    let src = this.src;
    console.log(src);
    $('#dbl-click-display').attr('src', src); // 設置圖片的src屬性
    $('.background').show();
});

$('#dbl-click-display').click(function(event){
   return false;
})

$('.background').click(function(event) {
    $(this).hide(); // 使用$(this)來隱藏背景
});



/**
 *  @method Scroll-to-X
 *  
 */

let prevousButton = document.querySelector('.prevous-image');
let imageSelector = document.querySelector('.image-selector-area');
let nextButton = document.querySelector('.next-image');
let moveDistance = (imageSelector.clientWidth / 1);

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

function getproductID(){
    var currentPath = window.location.pathname;
    var paramValue = currentPath.split('/').pop();
    return paramValue;
}

function getOption(){
    let option = document.getElementsByName('brand');
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
    var name = 'email_address=';
    var ca = document.cookie.split(';');
    console.log(ca);
    for(var i=0; i<ca.length; i++){
        var c = ca[i].trim();
        if (c.indexOf(name)==0) return c.substring(name.length,c.length);
    }
    
}

function sendData(option, quantity, productID, email){
    $.ajax({
        type: 'post',
        url: `/api/user/add-to-cart`,
        data: JSON.stringify({
            "product_code": productID,
            "brand_code": option,
            "quantity": quantity,
            "email": email
        }),
        contentType : "application/json;charset=utf-8",
        success: function(Text){
            // console.log(Text)
            location.reload();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown){
            // console.log(XMLHttpRequest.status);
            // console.log(XMLHttpRequest.readyState);
            // console.log(textStatus);
            location.reload();
        }
    })
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
}

addToCart.addEventListener('click', ()=>{
    let option = getOption();
    let quantity = getQuantity();
    let productID = getproductID();
    let encodedEmail = decodeURIComponent(getEmail())
    if(option !== undefined){
        sendData(option, quantity, productID, encodedEmail)
    }
})

