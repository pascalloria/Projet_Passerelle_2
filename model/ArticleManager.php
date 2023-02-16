<?php

class Article Extends Manager {

    public function getArticles() {
        $bdd = $this->connection();
        $request = $bdd->query('SELECT * FROM articles');
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
        $request = $bdd->prepare('INSERT INTO articles (title, article, id_user) VALUES (?, ?, ?)');
        $request->execute([$title, $article, $id_user]);
        return $request;
    }
    public function updateArticle($title, $article, $id_user, $id_article) {
        $bdd = $this->connection();
        $request = $bdd->prepare('UPDATE articles SET title=?, article=?, id_user=? WHERE id=?');
        $request->execute([$title, $article, $id_user, $id_article]);
        return $request;
    }

    public function deleteArticle($id_article) {
        $bdd = $this->connection();
        $request = $bdd->prepare('DELETE FROM articles WHERE id=?');
        $request->execute([$id_article]);
        return $request;
    }

}