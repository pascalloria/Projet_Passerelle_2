<?php

require_once("../controller/controller.php");

    try{
         if (!empty($_GET["page"])) {

        if ($get["page"]==="home"){
            home();
        } else if ($get["page"]==="contact"){
            //contact();
        } else {
            throw new Exception("Cette page n'existe pas");
        }

    } else{
         home();
    }
 
    
    } catch( Exception $e){
        $error = $e->getMessage();
        require("../view/errorView.php");
    }

   
   


