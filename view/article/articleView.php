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
                    <?php if (isset($_SESSION['id'])) echo $gear->controls($article['id_user'], $article['id'], $article['content'], $user['rank'], true); ?>
                </div>
            </div>
            <div class="card-body">

                <p><?= $article['content'] ?> </p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    <p>Ecrit par : <span class="fw-bold <?= Checker::colorMyRank($author['rank']) ?>"><?= $author['login'] ?></span> </p>
                </div>
                <div class="text-bg-dark rounded-3">
                    <div id="btnCom" class="btn border p-2 btn-outline-light  ">

                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="commentaires">
                            <small class="showMe me-2">Afficher</small><?= Checker::articleGotComs($article['id']) ?><i class="mx-2 fa-regular fa-comment"></i>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <p>Le : <?= DateToFr::dateFR($article['date']) ?> </p>
            </div>
        </div>
        <div class="showHidden d-none mb-5">
        <?php }

    while ($commentaries = $coms->fetch()) {

        $authorCom = Checker::getAuthor("commentaries", $commentaries['id_user']);

        ?>

            <div class="card col-md-8 col-lg-10 mx-auto mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><span class="<?= Checker::colorMyRank($authorCom['rank']) ?>"><?= $authorCom['login'] ?></span> le <?= DateToFr::dateFR($commentaries['date']) ?></h4>
                    <div>
                        <?php if (isset($_SESSION['id'])) echo $gear->controls($commentaries['id_user'], $commentaries['id'], $commentaries['content'], $user['rank']); ?>
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
                <div id="bubble" class="fixed-bottom d-flex justify-content-end align-items-center mb-5 me-md-5">
                    <div class="btn rounded-pill border border-3 border-danger  p-3 text-white  bg-dark " data-bs-toggle="tooltip" data-bs-placement="top" title="Ouvrir">
                        <i class="fa-solid fa-comments fs-4"></i>
                    </div>
                </div>
                <form class="form" method="post" action="index.php?page=article">

                    <div id="messenger" class="d-none d-flex flex-column fixed-bottom mb-md-2 rounded col-md-8 col-lg-10 mx-auto bg-dark pb-2 px-1 px-md-4 rounded-md-top border border-3 border-danger">
                        <div class=" d-flex justify-content-between align-items-center my-2 ">
                            <div id="title-messenger" class="text-danger ms-2">
                                <h5> Votre meilleur commentaire</h5>
                            </div>
                            <div class="bg-black rounded-pill border-0 ">
                                <button id="closeMessenger" type="button" class="btn btn-close btn-close-white btn-outline-light p-2 rounded-pill fs-4"></button>
                            </div>

                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <textarea id="com" class="form-control rounded-pill" name="content" id="content" cols="10" rows="1" maxlength="1024" placeholder="Votre commentaire..."></textarea>

                            <div class="bg-black  rounded-pill border-0">
                                <button id="comBtn" class="btn rounded-pill border-0 p-2 btn-outline-light" name="addCom" type="submit"><i class="fa-solid fa-paper-plane text-danger me-1"></i></button>
                            </div>
                        </div>
                        <div id="countCom" class="m-0 p-0 text-white">1024 caractères restants.</div>
                    </div>
                </form>
            <?php } else { ?>
                <div class=" col-md-8 col-lg-10 mx-auto ">
                    <div class="p-2  d-flex justify-content-center align-items-center gap-3 ">
                        <span>Vous devez être connecté pour pouvoir répondre:</span> <a href="index.php?page=connect" class="btn border btn-primary mx-2">Se Connecter</a>
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
