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
                    
                </div>
                <div class="card-body">
                    
                    <p class="text-truncate"><?= $articles['content'] ?> </p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-end gap-4" >
                    <div data-bs-toggle="tooltip" data-bs-placement="top" title="commentaires">
                        <?= Checker::articleGotComs($articles['id']) ?><i class="mx-2 fa-regular fa-comment" ></i>
                    </div>
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
