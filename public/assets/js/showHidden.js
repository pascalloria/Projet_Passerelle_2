const text = document.querySelector('.showMe');
const btnCom = document.querySelector('#btnCom');
const div = document.querySelector('.showHidden');

btnCom.addEventListener('click', () => {
    div.classList.toggle('d-none');
    if (text.textContent == 'Cacher les commentaires') {
        text.textContent= 'Afficher les commentaires';
    } else {
        text.textContent= 'Cacher les commentaires';
    }
});