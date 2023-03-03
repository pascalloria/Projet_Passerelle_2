const text = document.querySelector('.showMe');
const btnCom = document.querySelector('#btnCom');
const div = document.querySelector('.showHidden');
const bubble = document.querySelector('#bubble');
const messenger = document.querySelector('#messenger');
const titleMessenger = document.querySelector('#title-messenger');
const closeMessenger = document.querySelector('#closeMessenger');
const inputCom = document.querySelector('#com');

btnCom.addEventListener('click', () => {
    div.classList.toggle('d-none');
    if (text.textContent == 'Cacher') {
        text.textContent= 'Afficher';
    } else {
        text.textContent= 'Cacher';
    }
});

function showHidden(btn) {

    btn.addEventListener('click', () => {
        bubble.classList.toggle('d-none');
        messenger.classList.toggle('d-none');
        // je veux vraiment que ça soit mobile-friendly
        inputCom.focus();
        inputCom.value = "";
        
    });
    
}
showHidden(bubble);
showHidden(closeMessenger);