<?php

$title = "Acceuil";



ob_start();
?>

<div>
    rzerezr
</div>


<?php                               
        while($user = $requete->fetch()) {            
    ?>
        <p><b><?= $user['nickname'] ?></p>
    <?php
        }
    ?>




<?php 
$content = ob_get_clean();
require_once("base.php");
?>


