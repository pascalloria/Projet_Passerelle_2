
<?php

    require_once("../model/ProjectManager.php");
    require_once("../model/ArticleManager.php");

    
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
   
    
  

