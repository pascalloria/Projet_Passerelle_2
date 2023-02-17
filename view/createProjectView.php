<?php
    $title = "Creer votre Projet";
    ob_start();
?>

<h2> Projets </h2>
<form method="post" action="index.php?page=createProject">

    <p>
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" placeholder="Votre titre">
    </p>

    <p>
        <label for="content">Texte</label>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
    </p>   

    
    <p>
        <label for="id_user">auteur</label>
        <input name="id_user" id="id_user" placeholder="auteur"></textarea>
    </p>

    <input type="submit">

    
</form>       

   




<?php 
$content = ob_get_clean();
require_once("base.php");
?>
