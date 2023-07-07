
// 偵測元素高度
let navbar = document.querySelector('.navbar');
let navbarHeight = navbar.clientHeight ;
let body = document.querySelector('body')

window.addEventListener('scroll', scrollHeightNavbar)

function scrollHeightNavbar(){
    let windowHeight = window.scrollY;
    let classDetect = navbar.getAttribute('class').indexOf('scroll');

    if(windowHeight >= navbarHeight + 20 && classDetect < 0 ){
        navbar.classList.add('scroll');
        console.log('add');
    }else if(windowHeight < navbarHeight && classDetect > -1 ){
        navbar.classList.remove('scroll');
        console.log('remove');
    }
}