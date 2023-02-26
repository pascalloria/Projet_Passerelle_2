<?php
$title = "Erreur";
ob_start(); ?> 

    <h1>OUPS !</h1>
    <p><?=$error ?></p>
<?php 
$content = ob_get_clean();
require_once("base.php");
?>


    