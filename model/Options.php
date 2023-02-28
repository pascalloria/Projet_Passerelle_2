<?php

class Options
{

    public function controls($id_user, $id_artOrCom, $content, $isAdmin, $isArticle = false, )
    {
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            if ($id === $id_user || $isAdmin == "admin") {
                require('../view/article/optionsView.php');
            }
        }
    }
}
