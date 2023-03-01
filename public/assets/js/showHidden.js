const text = document.querySelector('.showMe');
// const com = document.querySelector('#com');
// déjà déclaré dans l'autre script
const btnCom = document.querySelector('#btnCom');
const div = document.querySelector('.showHidden');
const bubble = document.querySelector('#bubble');
const messenger = document.querySelector('#messenger');


btnCom.addEventListener('click', () => {
    div.classList.toggle('d-none');
    if (text.textContent == 'Cacher les commentaires') {
        text.textContent= 'Afficher les commentaires';
    } else {
        text.textContent= 'Cacher les commentaires';
    }
});

com.addEventListener('keyup', () => {
    if(com.value != 0) {
        closeMessenger.classList.add('d-none');
        messenger.classList.add('pt-4');
    } else {
        closeMessenger.classList.remove('d-none');
        messenger.classList.remove('pt-4');
    }
});

function showHidden(btn) {

    btn.addEventListener('click', () => {
        bubble.classList.toggle('d-none');
        messenger.classList.toggle('d-none');
    });
    
}
showHidden(bubble);
showHidden(closeMessenger);