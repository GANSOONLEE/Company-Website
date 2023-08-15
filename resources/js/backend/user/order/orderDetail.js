
/* ———————————————————— clipboard ———————————————————— */

const clipBoardButton = document.querySelectorAll('[data-action="clipboard"]');

for (let i = 0; i < clipBoardButton.length; i++) {
    clipBoardButton[i].addEventListener('click', (event) => {
        navigator.clipboard.writeText(event.target.innerText)
            .then(() => {
                console.log(event.target.innerText);
            })
            .catch((error) => {
                console.error('Clipboard write error:', error);
            });
        let clipboardNotice = document.querySelector('.clipboard');
        clipboardNotice.classList.remove('hidden')
        clipboardNotice.classList.add('show')
        setTimeout(()=>{
            clipboardNotice.classList.remove('show')
            clipboardNotice.classList.add('hidden')
        }, 2500)
    });
}
