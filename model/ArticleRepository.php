<?php

require_once('../model/DataBaseManager.php');

class ArticleRepository extends DBmanager
{
    const TABLE_ART = "articles";
    const TABLE_COM = "commentaries";
    public function getAllArticles()
    {
        $stmt = $this->getAll($this::TABLE_ART);
        return $stmt;
    }
    public function getOneArticle($id_article) {
        $bdd = $this->connection();
        $request = $bdd->prepare('SELECT * FROM '. $this::TABLE_ART.' WHERE id=?');
        $request->execute([$id_article]);
        return $request;
    }

    public function createArticle($title, $article, $id_user) {
        $bdd = $this->connection();
        $request = $bdd->prepare('INSERT INTO '. $this::TABLE_ART .' (title, content, id_user) VALUES (?, ?, ?)');
        $request->execute([$title, $article, $id_user]);
        return $request;
    }
    
    public function updateArticle($title, $content, $id_article) {
        $bdd = $this->connection();
        $request = $bdd->prepare('UPDATE '. $this::TABLE_ART .' SET title=?, content=? WHERE id=?');
        $request->execute([$title, $content, $id_article]);
        return $request;
    }

    public function deleteArticle($id_article) {
        $bdd = $this->connection();
        $request = $bdd->prepare('DELETE FROM '. $this::TABLE_ART .' WHERE id=?');
        $request->execute([$id_article]);
        return $request;
    }

    public function getAllComs() {
        $request = $this->getAll($this::TABLE_COM);
        return $request;

    }

    public function getAllComsOfThisArticle($id_article) {
        $bdd = $this->connection();
        $requestCom = $bdd->prepare('SELECT * FROM '.$this::TABLE_COM.' WHERE id_article=? ');
        $requestCom->execute([$id_article]);
        return $requestCom;
    }

    public function createCommentarie($content, $id_article, $id_user) {
        $bdd = $this->connection();
        $requestCom = $bdd->prepare('INSERT INTO '.$this::TABLE_COM.' (content, id_article, id_user) VALUES (?,?,?)');
        $requestCom->execute([$content, $id_article, $id_user]);
        return $requestCom;
    }

    public function updateCommentarie($content, $id_commentarie) {
        $bdd = $this->connection();
        $request = $bdd->prepare('UPDATE '.$this::TABLE_COM.' SET content=? WHERE id=?');
        $request->execute([$content, $id_commentarie]);
        return $request;
    }

    public function deleteCommentarie($id_commentarie) {
        $bdd = $this->connection();
        $request = $bdd->prepare('DELETE FROM '.$this::TABLE_COM.' WHERE id=?');
        $request->execute([$id_commentarie]);
        return $request;
    }





}