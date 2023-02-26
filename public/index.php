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
            clearMessage();
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
                successMessage();
                addCommentarie($content, $_SESSION['id_article'], $_SESSION['id']);
             
            } else if (!empty($_POST['delete-art'])) {
                $id_article = htmlspecialchars($_POST['delete-art']);
                eraseArticle($id_article);
                redirectArticles();
            } else if (!empty($_POST['delete-com'])) {
                $id_com = htmlspecialchars($_POST['delete-com']);
                eraseCommentarie($id_com);
                article($_SESSION['id_article']);
            } else if (!empty($_POST['update-com']) && !empty($_POST['content-com'])) {
                $newContent = htmlspecialchars($_POST['content-com']);
                $id_com = htmlspecialchars($_POST['update-com']);
                updateCom($newContent, $id_com);
                article($_SESSION['id_article']);
            }
            else {
                article($_SESSION['id_article']);
            }
        } else if ($_GET['page'] === 'inscription') {

            if (!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["password_two"])){
                // L'adresse email est-elle correcte ?
                $email=htmlspecialchars( $_POST["email"]);                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header('location: ?page=inscription&error=1&message=Votre adresse email est invalide.');
                    exit();
                }                
                // L'email n'est pas deja enregistrer ? 

                
                // Les passwords correspond t'il ?
                if ($_POST["password"] === $_POST["password_two"]){
                    $password = htmlspecialchars($_POST["password"]);
                    // cryptage du password
                    $password = "12452".sha1($password)."24478";

                } else {
                    header('location: ?page=inscription&error=1&message=Les 2 mots de passe ne correspondent pas');
                    exit();
                }
                // login libre.
                $login=htmlspecialchars($_POST["login"]);               
                if (!avalaibleLogin($login) == 1 ){                   
                    header('location: ?page=inscription&error=1&message=Le login n\'est pas disponible. Merci d\'en saisir un nouveau.');
                    exit();
                }                
                addUser($login,$password,$email) ;              
            }            
            register();



            
        } else if ($_GET['page'] === 'up-article') {
            
            $id_article = $_SESSION['id_article'];
            
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                $title_article = htmlspecialchars($_POST['title']);
                $article = htmlspecialchars($_POST['content']);
                modifyArticle($title_article, $article, $id_article);
            } else {     
                upArticleForm($id_article);    
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
