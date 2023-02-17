<?php

$title = "Acceuil";



ob_start();
?>

<?php if ($_GET["succes"]==1) { ?>
    <p class="bg-success"><?=$_GET["message"] ?></p>

<?php } 
?>
<h2> Projets </h2>


<?php                               
        while($project = $requete->fetch()) {            
    ?>
        <p><b><?= $project['title'] ?></b></p>
        <p> <?=$project["content"] ?></p>
        <p><i><?=$project["id_user"] ?> crée le <?=$project["date"] ?></i> </p>

            <!-- plus tard reserver a l'admin -->
        <p> <a href="index?page=createProject">Creer un article</a></p>

    <?php
        }
    ?>




<?php 
$content = ob_get_clean();
require_once("base.php");
?>


