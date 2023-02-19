<?php
$title = "Article";
$_SESSION['id'] = 1; //je simule un utilisateur connecté !
// $id_article = $_SESSION['id_article'];
ob_start();
?>
<form class="form" method="post" action="index.php?page=article">

    <div class="my-5">

        <h1>Votre article choisi est le numéro <?= $id_article ?></h1>


        <?php
        
        while ($article = $request->fetch()) {

            $author = Checker::getAuthor("articles", $article['id_user']);
        ?>
            <div class="card  mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2><?= $article['title'] ?></h2>
                    <div>
                        <?= Checker::controls($article['id_user']); ?>
                    </div>
                </div>
                <div class="card-body">

                    <p><?= $article['content'] ?> </p>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div>
                        <p>Ecrit par : <span class="fw-bold <?= Checker::colorMyRank($author['rank']) ?>"><?= $author['login'] ?></span> </p>
                        <p>Le : <?= DateToFr::dateFR($article['date']) ?> </p>
                    </div>
                    <div class="text-bg-dark rounded-3">
                        <div class="btn border p-2 btn-outline-light  ">
                            <?= Checker::articleGotComs($article['id']) ?><small> commentaires</small>
                        </div>
                    </div>

                </div>
            </div>
        <?php }
        if (isset($_SESSION['id'])) { ?>
            <div class="card col-md-8 col-lg-10 mx-auto mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Ajoutez un commentaire :</h4>
                </div>
                <div class="card-body">
                    <textarea class="form-control" name="content" id="content" cols="10" rows="5" maxlength="1024" placeholder="Votre commentaire..."></textarea>
                </div>
                <div class="card-footer d-flex justify-content-end ">
                    <div class="text-bg-dark rounded-3">
                        <button class="btn border p-2 btn-outline-light" name="addCom" type="submit">Ajouter</button>
                    </div>
                </div>
            </div>

        <?php } else { ?>
            <div class="alert alert-warning d-flex justify-content-center align-items-center">
                <p>Vous devez être connecté pour pouvoir répondre: <a href="#" class="btn btn-link    mx-2">Se Connecter</a></p>
            </div>
        <?php }

        while ($commentaries = $coms->fetch()) {

            $authorCom = Checker::getAuthor("commentaries", $commentaries['id_user']);
        ?>

            <div class="card col-md-8 col-lg-10 mx-auto mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><span class="<?= Checker::colorMyRank($authorCom['rank']) ?>"><?= $authorCom['login'] ?></span> le <?= DateToFr::dateFR($commentaries['date']) ?></h4>
                    <div>
                        <?= Checker::controls($commentaries['id_user']); ?>
                    </div>
                </div>
                <div class="card-body">

                    <p><?= $commentaries['content'] ?> </p>
                </div>

            </div>
        <?php } ?>

    </div>
</form>
<?php

$content = ob_get_clean();

require('base.php');
