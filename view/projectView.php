<?php

$title = "Acceuil";



ob_start();
?>

<h2> Projets </h2>


<?php                               
        while($project = $requete->fetch()) {            
    ?>
        <p><b><?= $project['title'] ?></b></p>
        <p> <?=$project["content"] ?></p>
        <p><i><?=$project["id_user"] ?> crée le <?=$project["date"] ?></i> </p>

    <?php
        }
    ?>




<?php 
$content = ob_get_clean();
require_once("base.php");
?>


