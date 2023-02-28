<?php
require_once('../model/ArticleRepository.php');


class ArticleController 
{
    
    public function __construct (private readonly ArticleRepository $articleRepository) {
    }
    
    function articles() {
        
        $request = $this->articleRepository->getAllArticles();

        require('../view/article/articlesView.php');
    }

    function article($id_article) {
        $request = $this->articleRepository->getOneArticle($id_article); //variable utilisé dans la view pour fetch
        $coms = $this->articleRepository->getAllComsOfThisArticle($id_article); //variable utilisé dans la view pour fetch
        require('../view/article/articleView.php');
    }

    function addCommentarie($content, $id_article, $id_user) {

        $newCom = $this->articleRepository->createCommentarie($content, $id_article, $id_user);
        
        if($newCom === false) {
            throw new Exception("Impossible d'ajouter votre avis pour le moment");
            exit();
            
        } else {
            header('location:index.php?page=article');
            exit();
        }
    }

    function newArticleForm() {
        require('../view/article/createArticleView.php');    
    }
    function upArticleForm($id_article) {
        
        $request = $this->articleRepository->getOneArticle($id_article);
        require('../view/article/modifArticleView.php');
    }
    function addArticle($title_article, $article, $id_user) {
        // Model
        $request = $this->articleRepository->createArticle($title_article, $article, $id_user);
        
        if(!$request) {
            throw new Exception("Impossible d'ajouter votre article pour le moment");
            exit();
            
        } else {
            header('location:index.php?page=articles');
            exit();
        }
    }
    
    function modifyArticle($title_article,$content,$id_article) {
        
        $request = $this->articleRepository->getOneArticle($id_article);
        $upArticle = $this->articleRepository->updateArticle($title_article,$content,$id_article);
        if(!$request || !$upArticle) {
            throw new Exception("Impossible d'ajouter votre avis pour le moment");
            
        } else {
            header('location:index.php?page=article');
            exit();
        }
    }
    function eraseArticle($id_article) {
       
        $request = $this->articleRepository->deleteArticle($id_article);
    }
    function eraseCommentarie($id_com) {
        
        $request = $this->articleRepository->deleteCommentarie($id_com);
    }
    function updateCom($newContent, $id_com) {
        
        $request = $this->articleRepository->updateCommentarie($newContent, $id_com);
    }

    
}