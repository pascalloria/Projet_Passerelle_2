
<?php

    require("../model/ProjectManager.php");

     function home() {
        // Model
        $projetManagers = new ProjectManager;
        $requete = $projetManagers->getAllProject();
        // view
        require("../view/projectView.php");        
    }

    function createProject() {
        // Model

        //View
        require ("../view/createProjectView.php");
    }

