
<?php
session_start();
    require_once("../model/ProjectManager.php");
    require_once("../model/ArticleManager.php");
    require_once('../model/Checker.php');
    require_once('../model/DateFr.php');
    require_once('../model/CommentariesManager.php');
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

    function redirect() {
        header('location:index.php?page=articles');
        exit();
    }