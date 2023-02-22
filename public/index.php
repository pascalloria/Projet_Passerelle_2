<?php

require_once("../controller/controller.php");

try {
    if (!empty($_GET["page"])) {
        if ($_GET["page"] === "home") {
            home();                    
        } else if ($_GET["page"] === "createProject"){  
            // Upload de l'image et recuperation du nom dans la variabel $img                   
            if (!empty($_FILES["img"])){                
                $img=uploadImage();
            } 
            // insertion des donné du projet dans la BDD projects
            if (!empty($_POST["title"] ) && !empty($_POST["content"]) && !empty($_POST["id_user"]) ){               
                addProject(htmlspecialchars($_POST["title"]),htmlspecialchars($_POST["content"]),htmlspecialchars($_POST["id_user"]),$img);
            } else {             
                createProject();                
            }              
        } else if ($_GET["page"] === "updateBddProject"){   
            // Upload de l'image et recuperation du nom dans la variabel $img                          
            if (!empty($_FILES["img"])){                
                $img=uploadImage();                
            } 
            // si aucun nouvelle image n'est proposé, on récupere le nom de l'image déja présente.
            if ($img == ""){                
                $img= $_SESSION["img"];
            } 
            // remplacement dans la table projects des informations modifié par l'utilisateur.
            updateBddProject(htmlspecialchars($_POST["title"]),htmlspecialchars($_POST["content"]),htmlspecialchars($_POST["id_user"]), $_SESSION["id"],$img);
        
        } else if ($_GET['page'] === 'new-article') {

            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                $title_article = htmlspecialchars($_POST['title']);
                $article = htmlspecialchars($_POST['content']);
                $id = $_SESSION['id'];
                addArticle($title_article, $article, $id);
            } else {
                newArticleForm();
            }
        } else if ($_GET['page'] === 'articles') {
            articles();
        } else if ($_GET['page'] === 'article') {            
            if (!empty($_POST['article'])) {
                // on récupère l'id de l'article pour afficher la bonne page et les bons commentaires
                $id_article = (int)htmlspecialchars($_POST['article']); // on le retransforme en int
                $_SESSION['id_article'] = $id_article;
            }
            if (!empty($_POST['content'])) {
                $content = htmlspecialchars($_POST['content']);
                // on ajoute un commentaire, en récuperant au passage les supers globales 
                //de SESSION -> ['id_article'] et ['id'] (c'est l'utilisateur connecté)
                // car nos variables se perdent lors du routing
                addCommentarie($content, $_SESSION['id_article'], $_SESSION['id']);             
            } else {
                article($_SESSION['id_article']);
            }
        } else {
            throw new Exception("Cette page n'existe pas");
        }
    
    } else {
        home();
    } 
    
   
} catch (Exception $e) {
    $error = $e->getMessage();
    require("../view/errorView.php");
}
