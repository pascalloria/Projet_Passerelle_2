<?php

$title = "Modifier votre Article";

ob_start();
?>
<div class="mt-5">

    <?php
    while ($article = $request->fetch()) { ?>
        <h1> Modification d'article </h1>
        <form class="form" method="post" action="index.php?page=up-article">

            <p>
                <label class="form-label" for="title">Titre</label>
                <input class="form-control" type="text" id="title" name="title" placeholder="Votre titre" maxlength="80" value="<?= $article['title'] ?>">               
            </p>
            <p>
                <label class="form-label" for="content">Texte</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10" maxlength="10000"><?= $article['content'] ?></textarea>
            </p>
            <button class="btn btn-outline-success mt-3" type="submit">Valider</button>

        </form>
</div>

<?php }
    $content = ob_get_clean();
    require('../view/base.php');

?>