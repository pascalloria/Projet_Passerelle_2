<?php

$title = "Creer votre Projet";



ob_start();
?>

<h2> Projets </h2>
<form method="post" action="index.php?page=home">

    <p>
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" placeholder="Votre titre">
    </p>

    <p>
        <label for="content">Texte</label>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
    </p>   

    
    <p>
        <label for="auteur">auteur</label>
        <input name="auteur" id="auteur" placeholder="auteur"></textarea>
    </p>

    <input type="submit">

    
</form>       

   




<?php 
$content = ob_get_clean();
require_once("base.php");
?>
