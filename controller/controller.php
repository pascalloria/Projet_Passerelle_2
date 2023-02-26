
<?php
session_start();
    require_once("../model/ProjectManager.php");
    require_once("../model/ArticleManager.php");
    require_once('../model/Checker.php');
    require_once('../model/DateFr.php');
    require_once('../model/CommentariesManager.php');


    
    // project
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
     function addProject($title,$content,$id_user) {
        // Model
        $projet = new ProjectManager;
        $result = $projet->addProject($title,$content,$id_user);
        echo $result;
        if ($result){
            header("location:index.php?page=home&&succes=1&&message=L'article à bien été créér");
        } else {
            throw new Exception("L'article n'a pas pu etre créer");
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
    function successMessage() {
        $_SESSION['success'] = 1;
    }
    function clearMessage() {
        unset($_SESSION['success']);
    }
