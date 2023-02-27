// le textarea ainsi que le message des caractères restants
const com = document.querySelector('#com');
const countCom = document.querySelector('#countCom');
const comBtn = document.querySelector('#comBtn');
// les textareas ainsi que le messages des caractères restants
// de l'utilisateur actuellement connecté
const comUp = document.querySelectorAll('.comUp');
const countComUp = document.querySelectorAll('.countComUp');
const comUpBtn = document.querySelectorAll('.comUpBtn');

// la valeur max du commentaire: entré en BDD /HTML et ici aussi 
const maxLength = 1024; 

// on met tout dans une fonction pour DRY
function infoText(text, remain, btn) {
    
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
        
 // on bloque l'envoi du formulaire au cas ou un petit malin change notre maxlength
        if(remaining < 0) {
            btn.classList.add('disabled');            
        } else {           
            btn.classList.remove('disabled');
        }
    });

// on protège au cas où avec 2 vérifications supplémentaires
    btn.addEventListener('mouseover', () => {
        if(text.value.length > maxLength) {
            btn.classList.add('disabled');            
        }
    });

    btn.addEventListener('focus', () => {
        if(text.value.length > maxLength) {
            btn.classList.add('disabled');            
        }
    });
}

infoText(com, countCom, comBtn);

for (let i = 0; i < comUp.length; i++) {
    infoText(comUp[i], countComUp[i], comUpBtn[i]);
}