<?php
$title = "Profil";

ob_start();

?>

<div class="my-5 d-flex flex-column justify-content-center align-items-center">
    <div class="col-12 col-md-8 col-lg-6 ">

        <form action="index.php?page=profile" method="post">
            <div class="container rounded p-4 bg-primary">

                <h1 class="text-center"><i class="fa-regular fa-id-badge me-1"></i> Profil</h1>
                <hr>
                <!-- la boucle principale centré sur l'utilisateur qui affiche ou non du contenu en fonction de son rang -->
                <?php while ($res = $user->fetch()) { ?>

                    <div id="block1">
                        <div class="mb-5 fs-4">Changement d'adresse email</div>
                        <div class="input-group my-4">
                            <span class="input-group-text">@</span>
                            <input class="form-control" type="email" name="email" id="email" value="<?= $res['email'] ?>">
                        </div>
                        <div class="input-group mb-5">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input class="form-control" type="text" name="password" id="password" placeholder="confirmer votre MDP pour modifier">
                        </div>
                        <div>
                            <button class=" btn btn-secondary form-control" type="submit" name="confirmEmail">Valider</button>
                        </div>
                        <div id="toggle-block1" class="btn pt-4 link-warning">Changer votre mot de passe ? </div>
                    </div>
                    <div id="block2" class="d-none">
                        <div class="mb-3 fs-4">Changement de mot de passe</div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input class="form-control" type="text" name="pass1" id="pass1" placeholder="mot de passe actuel">
                        </div>
                        <div class="input-group my-4">
                            <span class="input-group-text"><i class="fa-solid fa-unlock-keyhole"></i></span>

                            <input class="form-control" type="text" name="pass2" id="pass2" placeholder="nouveau mot de passe">
                        </div>
                        <div class="input-group mb-5">
                            <span class="input-group-text"><i class="fa-solid fa-unlock-keyhole"></i></span>

                            <input class="form-control" type="text" name="pass3" id="pass3" placeholder="confirmer nouveau MDP">
                        </div>
                        <div>
                            <button class=" btn btn-secondary form-control" type="submit" name="confirmEmail">Valider</button>
                        </div>
                        <div id="toggle-block2" class="btn pt-4 link-warning">Changer votre email ? </div>
                    </div>

            </div>

        </form>

    </div>
    <div class="col-12 col-md-8 col-lg-6 bg-warning rounded mt-4 p-4">
        <div class="d-flex flex-column ">
            <h2 class="align-self-center"><span><i class="fa-solid fa-star"></i></span> Mes Stats : </h2>
            <!-- les conditions avec la boucle principale -->
            <?php if ($res['rank'] == 'admin') { ?>

                <span>Nombres de projets : <?= $projects->rowCount() ?></span>
                <span>Nombres d'articles : <?= $articles->rowCount() ?></span>
            <?php } ?>
            <span>Nombres de commentaires : <?= $commentaries->rowCount() ?></span>
        </div>
    </div>
    <!-- les conditions avec la boucle principale -->

    <?php if ($res['rank'] == 'admin') { ?>
        <div class="col-12 col-md-8 col-lg-6 bg-warning rounded mt-4 p-4">
            <div>
                <h2 class="text-center"><i class="fa-solid fa-diagram-project"></i> Mes Projets:</h2>
                <span>Cliquez pour être redirigé sur le projet</span>
            </div>
            <?php while ($result = $projects->fetch()) { ?>
                <form action="index.php" method="post">
                    <div class="border rounded my-4">
                        <button class="rounded w-100" type="submit" name="project" value="<?= $result['id'] ?>">
                            <div class="mt-2"><span>Ecrit le : <?= DateToFr::dateFR($result['date']) ?></span> </div>
                            <hr>
                            <div class="w-100">
                                <p>Titre : <?= $result['title']?></p>
                                <hr>
                                <p class="text-truncate"><?= $result['content'] ?></p>
                            </div>
                        </button>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div class="col-12 col-md-8 col-lg-6 bg-warning rounded mt-4 p-4">
            <div>
                <h2 class="text-center"><i class="fa-solid fa-newspaper"></i> Mes Articles :</h2>
                <span>Cliquez pour être redirigé sur l'article</span>
            </div>
            <?php while ($result = $articles->fetch()) { ?>
                <form action="index.php?page=article" method="post">
                    <div class="my-4">
                        <button class="rounded w-100" type="submit" name="article" value="<?= $result['id'] ?>">
                            <div class="mt-2">Ecrit le : <?= DateToFr::dateFR($result['date']) ?></div>
                            <hr>
                            <div class="w-100"><span>Titre : <?= $result['title'] ?></span> </div>
                            <hr>
                            <div class="w-100">
                                <p class="text-truncate"> <?= $result['content'] ?> </p>
                            </div>
                        </button>
                    </div>
                </form>
            <?php } ?>
        </div>
<?php }
                } ?>
<div class="col-12 col-md-8 col-lg-6 bg-warning rounded my-4 p-4">
    <div>
        <h2 class="text-center"><i class="fa-solid fa-comments"></i> Mes commentaires :</h2>
        <span>Cliquez pour être redirigé sur l'article</span>
    </div>
    <?php while ($result = $commentaries->fetch()) { ?>
        <form action="index.php?page=article" method="post">
            <div class="my-4">
                <button class="rounded w-100" type="submit" name="article" value="<?= $result['id_article'] ?>">
                    <div class="mt-2"><span> Ecrit le : <?= DateToFr::dateFR($result['date']) ?></span></div>
                    <hr>
                    <div class=" w-100">
                        <p class="text-truncate"><?= $result['content'] ?> </p>
                    </div>
                </button>
            </div>
        </form>
    <?php } ?>
</div>

</div>
<?php
$content = ob_get_clean();
ob_start(); ?>
<script src="assets/js/profile.js"></script>
<?php
$script = ob_get_clean();
require('../view/base.php');
