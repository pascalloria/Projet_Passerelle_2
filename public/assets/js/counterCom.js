// le textarea ainsi que le message des caractères restants
const com = document.querySelector('#com');
const countCom = document.querySelector('#countCom');

// les textareas ainsi que le messages des caractères restants
// de l'utilisateur connecté
const comUp = document.querySelectorAll('.comUp');
const countComUp = document.querySelectorAll('.countComUp');

// la valeur max du commentaire: entré en BDD /HTML et ici aussi 
const maxLength = 1024; 

// on met tout dans une fonction pour DRY
function infoText(text, remain) {

    text.addEventListener('keyup', () => {
        let remaining = (maxLength - text.value.length);
        remain.textContent = remaining  + " caractères restants.";
        
        if (remaining > 200 ) {
            remain.classList.remove('text-danger','text-warning' );
        }
        if(remaining <= 200) {
            remain.classList.add('text-warning');
            remain.classList.remove('text-danger');            
        } 
        if(remaining <= 50) {
            remain.classList.add('text-danger');
            remain.classList.remove('text-warning');
        }
    });
}

infoText(com, countCom);

for (let i = 0; i < comUp.length; i++) {
    infoText(comUp[i], countComUp[i]);
}