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
            <?php require_once("../view/navbar.php") ?>
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

    <?php clearMessage();    
        }
       
    ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <div class="mt-2 container alert alert-danger"><?= $_SESSION["error"] ?></div>
    <?php clearMessage() ;
        }
        
    ?>


    <section class="flex-grow-1">
        <div class="container">
            <?= $content ?>
        </div>
    </section>



    <footer >
        <hr class="border border-primary border-3">
        <div class="container">
            <p class="text-primary">&copy; Mistrall et Eclat <i>@2023</i></p>
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