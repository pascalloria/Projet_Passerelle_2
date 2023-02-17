<?php

$title = "Créer votre Article";



ob_start();
?>

<h2> Création d'article </h2>
<form method="post" action="index.php?page=articles">

    <p>
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" placeholder="Votre titre" maxlength="80">
    </p>

    <p>
        <label for="content">Texte</label>
        <textarea name="content" id="article" cols="30" rows="10" maxlength="10000"></textarea>
    </p>   


    <input type="submit">

    
</form>       

   




<?php 
$content = ob_get_clean();
require_once("base.php");
?>
