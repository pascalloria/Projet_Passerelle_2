<?php

$title = "Créer votre Article";



ob_start();
?>
<div class="mt-5">

    <h2> Création d'article </h2>
    <form class="form" method="post" action="index.php?page=new-article">
        
        <p>
            <label class="form-label text-color2" for="title">Titre</label>
            <input class="form-control" type="text" id="title" name="title" placeholder="Votre titre" maxlength="80">
        </p>
        
        <p>
            <label class="form-label text-color2" for="content">Texte</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10" maxlength="10000"></textarea>
        </p>   
        
        
        <button class="btn btn-outline-primary mt-3" type="submit">Valider</button>
        
        
    </form>       
</div>

   




<?php 
$content = ob_get_clean();
require('../view/base.php');

?>
