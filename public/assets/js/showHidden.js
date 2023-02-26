const btn = document.querySelector('.showMe');
const div = document.querySelector('.showHidden');

btn.addEventListener('click', () => {
    div.classList.toggle('d-none');
    if (btn.textContent == 'Cacher les commentaires') {
        btn.textContent= 'Afficher les commentaires';
    } else {
        btn.textContent= 'Cacher les commentaires';
    }
});