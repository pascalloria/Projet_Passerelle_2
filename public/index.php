<?php

require_once("../controller/controller.php");

try {
    if (!empty($_GET["page"])) {

        if ($_GET["page"] === "home") {
            home();
        } else if ($_GET["page"] === "createProject") {
            createProject();
        } else if ($_GET['page'] === 'new-article') {
            
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                $title_article = htmlspecialchars($_POST['title']);
                $article = htmlspecialchars($_POST['content']);
                $id_user = 1; // mise en place des sessions plus tard
                addArticle($title_article, $article, 1);
            } else {
                newArticleForm();
            }
        } else if ($_GET['page'] === 'articles') {
            articles();
        } else {
            throw new Exception("Cette page n'existe pas");
        }
    } else {
        home();
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    require("../view/errorView.php");
}
