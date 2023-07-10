
var imageHover = document.querySelectorAll('.product-image-hoverable');
var imageDisplay = document.querySelector('.product-image-display');

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