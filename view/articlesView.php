<?php
$title = "Articles";


ob_start();
?>
<div class="my-5">

    <h1>Articles</h1>

    <p>Voici la liste des Articles, cliquez pour y accéder :</p>
    <form action="index.php?page=article" method="post">

        <?php
    while ($articles = $request->fetch()) {
        $author = Checker::getAuthor("articles", $articles['id_user']);
        ?>
        
            <div class="card  mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2><?= $articles['title'] ?></h2>
                    <div class="badge fs-6  bg-primary">
                        <?= Checker::articleGotComs($articles['id']) ?><small> commentaires</small> 
                    </div>
                </div>
                <div class="card-body">
                    
                    <p class="text-truncate"><?= $articles['content'] ?> </p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div>
                        <p>ecrit par : <span class="fw-bold <?= Checker::colorMyRank($author['rank']) ?>"><?= $author['login'] ?></span> </p>
                        <p>le : <?= DateToFr::dateFR($articles['date']) ?> </p>
                    </div>
                    <div class="text-bg-dark rounded-3">
                        <button class="btn btn-outline-light" type="submit" value="<?=$articles['id']?>" name="article">Voir plus</button>
                    </div>
                </div>
            </div>
            <?php
    }
    ?>
    
</form>

</div>

<?php

$content = ob_get_clean();

require('base.php');
