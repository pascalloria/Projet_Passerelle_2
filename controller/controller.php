
<?php
session_start();
    require_once("../model/ProjectManager.php");
    require_once("../model/ArticleManager.php");
    require_once('../model/Checker.php');
    require_once('../model/DateFr.php');
    require_once('../model/CommentariesManager.php');
     require_once("../model/ImageManager.php");
    require_once("../model/UsersManager.php");

    
    // project
    function home() {
        
        //Model
        $projects = new ProjectManager;
        $requete = $projects->getAllProject();
        if (!$requete){
            throw new Exception("Les projets n'ont pas pus etre afficher");
            exit();
        } 

        if (!empty($_GET["deleteId"])){            
            deleteProject($_GET["deleteId"]);

        } else if (!empty($_GET["updateId"])){             
            updateProject($_GET["updateId"]);
        } 
        // view 
        require("../view/projectsView.php");  


    }

    function createProject() {
        //View
        require ("../view/createProjectView.php");
    }

    function uploadImage(){
        $image = new ImageManager;
        $result = $image->uploadImg();
        return $result;   
    }

    function addProject($title,$content,$id_user,$img) {
        // Model
        $projet = new ProjectManager;
        $result = $projet->addProject($title,$content,$id_user,$img);     
        if (!$result){
           throw new Exception("Le projet ne peux pas etre CREER pour le moment si l'erreur persiste, merci de contacter l'administrateur"); 
           exit();         
        } else {
            header("location:index.php?page=home&&success=1&&message=Le projet à bien été créér");
            exit();
        }
    }

    function deleteProject ($id) {              
        $projet = new ProjectManager;        
        $result = $projet->deleteProject($id);    
        if ($result === 0 ){            
            throw new Exception("Le projet ne peux pas etre SUPPRIMER pour le moment si l'erreur persiste, merci de contacter l'administrateur");  
        } else {
            header("location:index.php?page=home&&success=1&&message=Le projet à bien été supprimer");
        }
    }

    function updateProject ($id){ 
        // Model       
        $project = new ProjectManager;        
        $request=$project->updateProject($id);        
        // View
        require ("../view/updateProjectView.php");
    }  
   
    function updateBddProject ($title,$content,$id_user,$id,$img){
        $project = new ProjectManager;
        $result =$project->updateProjectBdd($title,$content,$id_user,$id,$img);
        if ($result ===0){
            throw new Exception("La modification du projet à échouer. Veuiller contacter l'administrateur du site");
        } else {
            header("location:index.php?success=1&message=La modification est effecuté avec suces");
            exit();
        }     
    }
// article
    function articles() {
        $articles = new ArticleManager;
        $request = $articles->getAllArticles();

        require('../view/articlesView.php');
    }

    function article($id_article) {
        $article = new ArticleManager;
        $request = $article->getOneArticle($id_article); //variable utilisé dans la view pour fetch
        $commentaries = new CommentariesManager;
        $coms = $commentaries->getAllComsOfThisArticle($id_article); //variable utilisé dans la view pour fetch
        require('../view/articleView.php');
    }

    function addCommentarie($content, $id_article, $id_user) {
        $commentarie = new CommentariesManager;
        $newCom = $commentarie->createCommentarie($content, $id_article, $id_user);
        
        if($newCom === false) {
            throw new Exception("Impossible d'ajouter votre avis pour le moment");
            exit();
            
        } else {
            header('location:index.php?page=article');
            exit();
        }
    }

    function newArticleForm() {
        require('../view/createArticleView.php');    
    }
    function upArticleForm($id_article) {
        $article = new ArticleManager;
        $request = $article->getOneArticle($id_article);
        require('../view/modifArticleView.php');
    }
    function addArticle($title_article, $article, $id_user) {
        // Model
        $articleManager = new ArticleManager;
        $request = $articleManager->createArticle($title_article, $article, $id_user);
        
        if(!$request) {
            throw new Exception("Impossible d'ajouter votre article pour le moment");
            exit();
            
        } else {
            header('location:index.php?page=articles');
            exit();
        }
    }
    
    function modifyArticle($title_article,$content,$id_article) {
        $articleManager = new ArticleManager;
        $request = $articleManager->getOneArticle($id_article);
        $upArticle = $articleManager->updateArticle($title_article,$content,$id_article);
        if(!$request || !$upArticle) {
            throw new Exception("Impossible d'ajouter votre avis pour le moment");
            
        } else {
            header('location:index.php?page=article');
            exit();
        }
    }
    function eraseArticle($id_article) {
        $articleManager = new ArticleManager;
        $request = $articleManager->deleteArticle($id_article);
    }
    function eraseCommentarie($id_com) {
        $articleManager = new CommentariesManager;
        $request = $articleManager->deleteCommentarie($id_com);
    }
    function updateCom($newContent, $id_com) {
        $commentarieManager = new CommentariesManager;
        $request = $commentarieManager->updateCommentarie($newContent, $id_com);
    }
    function redirectArticles() {
        header('location:index.php?page=articles');
        exit();
    }

    function redirect2($path) {
        header('location:'.$path);
        exit();
    }

    // user  


    function register(){
        require("../view/signInView.php");
    }

    function avalaibleLogin($login){
        $user = new UserManagers;
        $req= $user->avalaibleLogin($login);        
        while ($res =$req->fetch()){
            if ($res["loginNumber"] != 0){
               return false;
            }			
        }        
    }

    function addUser($login,$password,$email,){

        //model       
        $user = new UserManagers;
        $user->addUserBdd($login,$password,$email,);

        if($user){
            header("location: index.php?success=1&message=Votre compte à été créer avec sucèss");
            exit();
        } else {
            throw new Exception("Un probleme est survenue lors de la création de votre compte");
            exit();
        }        
    }