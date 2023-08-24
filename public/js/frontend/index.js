
let fadeLeft = {
    distance: '20%',
    origin: 'top',
    opacity: 0,
    duration: 750,
    easing: 'cubic-bezier(0.6, 0.2, 0.1, 1)',
    interval: 75,
    cleanup: true,
    viewFactor: 0.3,
    afterReveal: function (domEl){
        domEl.style = '';
    }
};

ScrollReveal().reveal('.mission-card', fadeLeft);


let slideUp = {
    distance: '30%',
    origin: 'bottom',
    opacity: 0,
    duration: 970,
    easing: 'ease-in-out',
    interval: 125,
    cleanup: true,
    viewFactor: 0.4,
    afterReveal: function (domEl){
        domEl.style = '';
    }
}

ScrollReveal().reveal('.organize-hexagon', slideUp);

