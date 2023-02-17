<?php

require_once("../controller/controller.php");

    try{
         if (!empty($_GET["page"])) {

        if ($_GET["page"]==="home"){
            home();
            
        } else if ($_GET["page"]==="createProject"){    
            if (!empty($_POST["title"] ) && !empty($_POST["content"]) && !empty($_POST["id_user"]) ){               
                addProject(htmlspecialchars( $_POST["title"]),htmlspecialchars($_POST["content"]),htmlspecialchars($_POST["id_user"]));
            } else {             
                createProject();
            } 
        } else {
            throw new Exception("Cette page n'existe pas");
        }
    } else {
        home();
    } 
    
    } catch( Exception $e){
        $error = $e->getMessage();
        require("../view/errorView.php");
    }

   
   


