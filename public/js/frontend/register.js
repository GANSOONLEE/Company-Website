
function initForm(){
    var nextBtn = document.querySelector('button[data-button-identify="next"]');
    var previousBtn = document.querySelector('button[data-button-identify="previous"]');

    nextBtn.addEventListener('click', switchToNextPart);
    previousBtn.addEventListener('click', switchToPreviousPart);

}

function switchToNextPart(){
    firstPart.setAttribute('data-visible', 'false');
    secondPart.setAttribute('data-visible', 'true');
}

function switchToPreviousPart(){
    firstPart.setAttribute('data-visible', 'true');
    secondPart.setAttribute('data-visible', 'false');
}

var firstPart = document.querySelector('div[data-index="1"]');
var secondPart = document.querySelector('div[data-index="2"]');

initForm()