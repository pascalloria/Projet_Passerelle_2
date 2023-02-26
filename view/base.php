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

    <header class="bg-primary">
        <div class="container">
            <nav class="navbar  navbar-expand-md">
                <div class="navbar-brand">
                    <h1> The blog</h1>
                </div><!-- Le bouton s'affichera en petit écran -->
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#monMenuDeroulant">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="monMenuDeroulant">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php?page=home" class="nav-link active">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=articles" class="nav-link">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=new-article" class="nav-link">créer article</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                    </ul>
                    
                </div>
            
            </nav>   
        </div>
        <?php if (isset($_SESSION['id'])) {
            $user = Checker::getNameAndRank($_SESSION['id'])?>
                <div class="p-2 bg-light">
                    <div class="container d-flex justify-content-between">
                        <div>

                            <i class="fa-regular fa-circle-user"></i>
                            <p class="d-inline"><span class="<?=Checker::colorMyRank($user['rank']) ?>"><?=$user['login'] ?></span></p>
                        </div>
                        <div id="weather">

                        </div>
                    </div>
                </div>           
            <?php } ?>     
    </header>   
    <?php if(isset($_SESSION['success'])) { ?>
        <div class="mt-2 container alert alert-success">Contenu mis à jour !</div>
    <?php }
    ?>

    <section class="flex-grow-1">
        <div class="container">

            <?=$content ?>
        </div>
    </section>



    <footer>
       <hr>
        <div class="container"><p>Créé par Mistrall et Eclat</p></div>
        

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/js/enableTooltips.js"></script>
    <?php if(isset($_SESSION['id'])) { ?>
        <script src="assets/js/weatherBar.js"></script>   
        <?php }?>
    <?= $script ?>

</body>
