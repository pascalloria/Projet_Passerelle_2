<?php
$title = "Article";
// $_SESSION['id'] = 2; //je simule un utilisateur connecté !

ob_start();
?>

<div class="my-5">
    <?php

    while ($article = $request->fetch()) {
        $author = Checker::getAuthor("articles", $article['id_user']);
    ?>
        <div class="card  mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1><?= $article['title'] ?></h1>
                <div>
                    <?= Checker::controls($article['id_user'], $article['id'], $article['content'], true); ?>
                </div>
            </div>
            <div class="card-body">

                <p><?= $article['content'] ?> </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-end gap-4">
                <div data-bs-toggle="tooltip" data-bs-placement="top" title="commentaires">
                    <?= Checker::articleGotComs($article['id']) ?><i class="mx-2 fa-regular fa-comment"></i>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    <p>Ecrit par : <span class="fw-bold <?= Checker::colorMyRank($author['rank']) ?>"><?= $author['login'] ?></span> </p>
                    <p>Le : <?= DateToFr::dateFR($article['date']) ?> </p>
                </div>
                <div class="text-bg-dark rounded-3">
                    <div  id="btnCom" class="btn border p-2 btn-outline-light  ">
                        <small class="showMe"> Voir les commentaires</small>
                    </div>
                </div>

            </div>
        </div>
    <div class="showHidden d-none">
        <?php }
    if (isset($_SESSION['id'])) { ?>

            <form class="form" method="post" action="index.php?page=article">

                <div class="card col-md-8 col-lg-10 mx-auto mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Ajoutez un commentaire :</h4>
                    </div>
                    <div class="card-body">
                        <textarea id="com" class="form-control" name="content" id="content" cols="10" rows="7" maxlength="1024" placeholder="Votre commentaire..."></textarea>
                    </div>
                    <div class="card-footer d-flex justify-content-end align-items-center gap-4">
                        <div id="countCom"></div>
                        <div class="text-bg-dark rounded-3">
                            <button class="btn border p-2 btn-outline-light" name="addCom" type="submit">Ajouter</button>
                        </div>
                    </div>
                </div>
            </form>
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
                        <?= Checker::controls($commentaries['id_user'], $commentaries['id'], $commentaries['content']); ?>
                    </div>
                </div>
                <div class="card-body">

                    <p><?= $commentaries['content'] ?> </p>
                </div>

            </div>
        <?php } ?>

        </div>
</div>

<?php
$content = ob_get_clean();
ob_start(); ?>
<script src="assets/js/showHidden.js"></script>
<?php if(isset($_SESSION['id'])) {?>
    <script src="assets/js/counterCom.js"></script>
<?php } 
$script = ob_get_clean();
require('base.php');
