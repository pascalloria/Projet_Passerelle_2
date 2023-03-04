<?php 
// on récupère tout de suite le login et le rang de l'utilisateur connecté pour l'affichage
if(isset($_SESSION['id'])) $me = Checker::getLoginAndRank($_SESSION['id']); 
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../design/default.css">
    <script src="https://kit.fontawesome.com/2847cc80c5.js" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column">

    <header class="bg-color1">
        <div class="container">
            <nav class="navbar  navbar-expand-md">
                <div class="navbar-brand">
                    <h1 class="text-color2"> Diablo 4 Blog</h1>
                </div><!-- Le bouton s'affichera en petit écran -->
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#monMenuDeroulant">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="monMenuDeroulant">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php?page=home" class="nav-link active text-color2"><i class="fa-solid fa-house"></i></i> Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=articles" class="nav-link text-color2"><i class="fa-solid fa-newspaper"></i> Articles</a>
                        </li>
                        <?php if(isset($_SESSION['id']) && $me['rank'] == 'admin') { ?>
                        <li class="nav-item">
                            <a href="index.php?page=new-article" class="nav-link text-color2"><i class="fa-solid fa-pen-to-square"></i> créer article</a>
                        </li>
                            <?php }?>

                        <?php if (!empty($_SESSION["id"])) { ?>
                            <li class="nav-item">
                                <a href="index.php?page=profil" class="nav-link text-color2"><i class="fa-regular fa-id-badge me-1"></i> Profil</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=logout" class="nav-link text-color2"><i class="fa-solid fa-moon me-1"></i> Déconnection</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a href="index.php?page=connect" class="nav-link text-color2"><i class="fa-solid fa-plug me-1"></i>Connection</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=inscription" class="nav-link text-color2"><i class="fa-regular fa-file-lines me-1"></i>inscription</a>
                            </li>
                        <?php
                        } ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-color2"><i class="fa-solid fa-user me-1"></i> Contact</a>
                        </li>
                        <?php if(isset($_SESSION['id']) && $me['rank'] == 'admin') { ?>
                            <li class="nav-item">
                                <a href="index.php?page=admin" class="nav-link text-color2"><i class="fa-solid fa-user me-1"></i> admin</a>
                            </li>
                        <?php }?>
                        


                    </ul>

                </div>

            </nav>
        </div>
        <?php if (isset($_SESSION['id'])) {
            
             ?>
            <div class="p-2 bg-color4">
                <div class="container d-flex justify-content-between align-items-center flex-wrap text-color2">
                    <div>

                        <i class="fa-regular fa-circle-user"></i>
                        <p class="d-inline"><span class="<?= Checker::colorMyRank($me['rank']) ?> fs-5"><?= $me['login'] ?></span></p>
                    </div>
                    <div>
                        <!-- pour le fun un petit score de participation -->
                        <span><i class="fa-solid fa-trophy text-primary"></i> Mon score : <?= Checker::getMyScore($_SESSION['id']) ?></span>
                    </div>
                    <div id="weather">

                    </div>
                </div>
            </div>
        <?php } ?>
    </header>
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="mt-2 container alert alert-success"><?= $_SESSION["success"] ?></div>
    <?php }
       clearMessage()
    ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <div class="mt-2 container alert alert-danger"><?= $_SESSION["error"] ?></div>
    <?php }
        clearMessage()
    ?>


    <section class="flex-grow-1">
        <div class="container">
            <?= $content ?>
        </div>
    </section>



    <footer >
        <hr class="border border-primary border-3">
        <div class="container">
            <p class="text-primary">Créé par Mistrall et Eclat</p>
        </div>


    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/js/enableTooltips.js"></script>
    <script src="assets/js/clearMessage.js"></script>

    <?php if (isset($_SESSION['id'])) { ?>
        <script src="assets/js/weatherBar.js"></script>
    <?php }
    if (isset($script)) {
        echo $script;
    }

    ?>

</body>