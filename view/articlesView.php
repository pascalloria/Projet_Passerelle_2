<?php
$title = "Articles";
require_once('../model/Checker.php');
require_once('../model/DateFr.php');
ob_start();
?>
<div class="my-5">

    <h1>Articles</h1>

    <p>Voici la liste des Articles :</p>

    <?php
    while ($articles = $request->fetch()) {
        $author = Checker::getAuthor("articles", $articles['id_user']);
    ?>
        <div class="border border-4 p-3 mb-4">

            <h2><?= $articles['title'] ?></h2>
            <p>ecrit par : <span class="fw-bold <?= Checker::colorMyRank($author['rank']) ?>"><?= $author['login'] ?></span> , le : <?=DateToFr::dateFR($articles['date'])?> </p>
            <p><?= $articles['content'] ?> </p>
        </div>
    <?php
    }
    ?>

</div>

<?php

$content = ob_get_clean();

require('base.php');
