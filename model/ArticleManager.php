<?php
require_once('Manager.php');

class ArticleManager Extends Manager {

    public function getAllArticles() {
        $request = $this->getAll('articles');
        return $request;
    }

    public function getOneArticle($id_article) {
        $bdd = $this->connection();
        $request = $bdd->prepare('SELECT * FROM articles WHERE id=?');
        $request->execute([$id_article]);
        return $request;
    }

    public function createArticle($title, $article, $id_user) {
        $bdd = $this->connection();
        $request = $bdd->prepare('INSERT INTO articles (title, content, id_user) VALUES (?, ?, ?)');
        $request->execute([$title, $article, $id_user]);
        return $request;
    }
    
    public function updateArticle($title, $content, $id_article) {
        $bdd = $this->connection();
        $request = $bdd->prepare('UPDATE articles SET title=?, content=? WHERE id=?');
        $request->execute([$title, $content, $id_article]);
        return $request;
    }

    public function deleteArticle($id_article) {
        $bdd = $this->connection();
        $request = $bdd->prepare('DELETE FROM articles WHERE id=?');
        $request->execute([$id_article]);
        return $request;
    }

}