<?php

require_once("DataBaseManager.php");

class CommentariesManager extends DBManager {
    public function getAllComs() {
        $request = $this->getAll('commentaries');
        return $request;

    }

    public function getAllComsOfThisArticle($id_article) {
        $bdd = $this->connection();
        $requestCom = $bdd->prepare('SELECT * FROM commentaries WHERE id_article=? ');
        $requestCom->execute([$id_article]);
        return $requestCom;
    }

    public function createCommentarie($content, $id_article, $id_user) {
        $bdd = $this->connection();
        $requestCom = $bdd->prepare('INSERT INTO commentaries (content, id_article, id_user) VALUES (?,?,?)');
        $requestCom->execute([$content, $id_article, $id_user]);
        return $requestCom;
    }

    public function updateCommentarie($content, $id_commentarie) {
        $bdd = $this->connection();
        $request = $bdd->prepare('UPDATE commentaries SET content=? WHERE id=?');
        $request->execute([$content, $id_commentarie]);
        return $request;
    }

    public function deleteCommentarie($id_commentarie) {
        $bdd = $this->connection();
        $request = $bdd->prepare('DELETE FROM commentaries WHERE id=?');
        $request->execute([$id_commentarie]);
        return $request;
    }
}