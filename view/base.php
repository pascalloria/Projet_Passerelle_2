<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../design/default.css">
    
</head>
<body>

    <header class="bg-primary">
    </header>

    <nav class="navbar  navbar-expand-md bg-primary">
        <div class="container"  >
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
                        <a href="index.php?page=contact" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>           
    </nav>   
           
      


    <section>
        <div class="container">

            <?=$content ?>
        </div>
    </section>



    <footer>
       <hr>
        <div class="container"><p>Créé par Mistrall et Eclat</p></div>
        
    </footer>    
</body>
