
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
 *  @method scrollX
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
    imageSelector.scrollTo(scrollX-moveDistance, 0);
})

nextButton.addEventListener('click', ()=>{
    console.log('next')
    let scrollX = getScrollX()
    imageSelector.scrollTo(scrollX+moveDistance, 0);
})

imageSelector.scrollIntoView({
    behavior: 'smooth',
})