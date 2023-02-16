
<?php

    require("../model/UserManager.php");

 function home() {
    // Model
    $userManagers = new UserManager;
     $requete = $userManagers->getAllUser();

    // view
    require("../view/acceuilView.php");
}

