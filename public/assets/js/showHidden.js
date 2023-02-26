const btn = document.querySelector('.showMe');
const div = document.querySelector('.showHidden');

btn.addEventListener('click', () => {
    div.classList.toggle('d-none');
});