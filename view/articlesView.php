<?php
$title = "Articles";

ob_start();
?>
<section class="container">
        
            <h1>Articles</h1>
           
            <p>Voici la liste des Articles :</p>

            <?php
                while($articles = $request->fetch()) { 
            ?>
                <p><b><?= $articles['date'] ?> <?= $articles['article'] ?></b> : ecrit par : <?= $articles['id_user'] ?></p>
            <?php
                }
            ?>

        </section>

<?php

$content = ob_get_clean();

require('base.php');