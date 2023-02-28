<?php
$title = "Article";

ob_start();
?>

<div class="my-5">
    <?php
    if (isset($_SESSION['id'])) {
        $user = Checker::getLoginAndRank($_SESSION['id']);
    }
    while ($article = $request->fetch()) {
        $author = Checker::getAuthor("articles", $article['id_user']);
    ?>
        <div class="card  mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1><?= $article['title'] ?></h1>
                <div>
                    <?= $gear->controls($article['id_user'], $article['id'], $article['content'],$user['rank'], true); ?>
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
                    <div id="btnCom" class="btn border p-2 btn-outline-light  ">
                        <small class="showMe"> Voir les commentaires</small>
                    </div>
                </div>

            </div>
        </div>
        <div class="showHidden d-none">
        <?php }

            while ($commentaries = $coms->fetch()) {

            $authorCom = Checker::getAuthor("commentaries", $commentaries['id_user']);
            ?>

            <div class="card col-md-8 col-lg-10 mx-auto mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><span class="<?= Checker::colorMyRank($authorCom['rank']) ?>"><?= $authorCom['login'] ?></span> le <?= DateToFr::dateFR($commentaries['date']) ?></h4>
                    <div>
                        <?= $gear->controls($commentaries['id_user'], $commentaries['id'], $commentaries['content'], $user['rank']); ?>
                    </div>
                </div>
                <div class="card-body">

                    <p><?= $commentaries['content'] ?> </p>
                </div>

            </div>
        <?php } ?>

        </div>
        <div>
            <?php if (isset($_SESSION['id'])) { ?>

                <form class="form" method="post" action="index.php?page=article">

                    <div class="card col-md-8 col-lg-10 mx-auto mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Ajoutez un commentaire :</h4>
                        </div>
                        <div class="card-body">
                            <textarea id="com" class="form-control" name="content" id="content" cols="10" rows="2" maxlength="1024" placeholder="Votre commentaire..."></textarea>
                        </div>
                        <div class="card-footer d-flex justify-content-end align-items-center gap-4">
                            <div id="countCom"></div>
                            <div class="text-bg-dark rounded-3">
                                <button id="comBtn" class="btn border p-2 btn-outline-light" name="addCom" type="submit">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } else { ?>
                <div  class=" col-md-8 col-lg-10 mx-auto ">
                    <div class="p-2 border rounded-3 d-flex justify-content-center align-items-center ">
                        <span >Vous devez être connecté pour pouvoir répondre:</span> <a href="index.php?page=connect" class="btn border btn-primary mx-2">Se Connecter</a>
                    </div>
                </div>
            <?php } ?>
        </div>

</div>

<?php
$content = ob_get_clean();
ob_start(); ?>
<script src="assets/js/showHidden.js"></script>
<?php if (isset($_SESSION['id'])) { ?>
    <script src="assets/js/counterCom.js"></script>
<?php }
$script = ob_get_clean();
require('../view/base.php');
