<?php

require_once("../controller/controller.php");
require_once("../controller/ProjectController.php");
require_once("../controller/UserController.php");


try {
    //clearMessage();
    if (!empty($_GET["page"])) {
        $project = new ProjectController(new ProjectRepository);
        $user = new UsersController(new UsersRepository);


        if ($_GET["page"] === "home") {            
            $project->home();                                
        } else if ($_GET["page"] === "createProject"){  
            // verifions si l'utilisateur est admin
            if ($user->isAdmin() == 1){
                // Upload de l'image et recuperation du nom dans la variabel $img                   
                if (!empty($_FILES["img"])){                
                    $img=$project->uploadImage();
                } 
                // insertion des données du projet dans la BDD "projects"
                if (!empty($_POST["title"] ) && !empty($_POST["content"]) ){                               
                    $project->addProject(htmlspecialchars($_POST["title"]),htmlspecialchars($_POST["content"]),$img);
                } else {          
                    // affice la vue CreateProjectView
                    $project->createProject();                
                }    
            }  else {
               throw new Exception("Vous n'avez pas les droits requis pour réaliser cette action. Veuillez contactez un administrateur");
            }        
        } else if ($_GET["page"] === "updateBddProject"){
            if ($user->isAdmin() == 1){ 
                // Upload de l'image et recuperation du nom dans la variabel $img                          
                if (!empty($_FILES["img"]["size"] && !$_FILES["img"]["size"] == 0)){                              
                    $img=$project->uploadImage();                                  
                } 
                // si aucun nouvelle image n'est proposé, on récupere le nom de l'image déja présente.
                if ($img == ""){                
                    $img= $_SESSION["img"];
                } 
                // remplacement dans la table projects des informations modifié par l'utilisateur.
                $project->updateBddProject(htmlspecialchars($_POST["title"]),htmlspecialchars($_POST["content"]), $_SESSION["Project_id"],$img);
            }  else {
                throw new Exception("Vous n'avez pas les droits requis pour réaliser cette action. Veuillez contactez un administrateur");
            }   
        
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
                successMessage("contenue mis a jour");
                addCommentarie($content, $_SESSION['id_article'], $_SESSION['id']);
             
            } else if (!empty($_POST['delete-art'])) {
                $id_article = htmlspecialchars($_POST['delete-art']);
                eraseArticle($id_article);
                redirect("index.php?page=articles");
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

        } else if ($_GET['page'] === 'up-article') {        
            $id_article = $_SESSION['id_article'];
            
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                $title_article = htmlspecialchars($_POST['title']);
                $article = htmlspecialchars($_POST['content']);
                modifyArticle($title_article, $article, $id_article);
            } else {     
                upArticleForm($id_article);    

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
                if (!$user->avalaibleLogin($login) == 1 ){                   
                    header('location: ?page=inscription&error=1&message=Le login n\'est pas disponible. Merci d\'en saisir un nouveau.');
                    exit();
                }                
                $user->addUser($login,$password,$email) ;              
            }            
            $user->register();

        } else if ($_GET['page'] ==="connect" ){
            if(!empty($_POST["login"]) && !empty($_POST['password']))  {
                $password = "12452".sha1(htmlspecialchars($_POST['password']))."24478";
                $user->connectUser(htmlspecialchars($_POST["login"]),$password);
            }         
            $user->connection();   
        } else if ($_GET['page'] ==="logout" ){
            $user->logout();
        } else {
            throw new Exception("Cette page n'existe pas");
        }
    
    } else {
        $project = new ProjectController(new ProjectRepository);
        $project->home();     
        
    } 
    
   
} catch (Exception $e) {
    $error = $e->getMessage();
    require("../view/errorView.php");
}
