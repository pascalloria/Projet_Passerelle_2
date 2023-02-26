<?php
    $title = "Inscription";
    ob_start();
?>
<div class="my-5 w-50 mx-auto">
    <h2 class="text-center"> Projets </h2>
<?php 
    if (isset($_GET["success"])){
    if ($_GET["success"] == 1) { ?>

        <p class="card m-2 p-1 bg-success d-inline-block"><?=$_GET["message"] ?></p>  
<?php }
} ?>
    <div class="">

    
        <form  class="form " method="post" action=".?page=inscription">

            <p>
                <label class="label" for="login"></label>
                <input class="control-form-sm" type="text" name="login" id="login" placeholder="Entrer votre pseudo" required >
            </p>

            <p>
                <label class="label" for="email"></label>
                <input class="control-form" type="email" name="email" id="email" placeholder="Entrer un email valide" required>
            </p>

            <p>
                <label class="label" for="password"></label>
                <input class="control-form-sm" type="password" name="password" id="password" required>
                <input class="control-form-sm" type="password" name="password_two" id="password_two" required>
            </p>

            <button type="submit">S'inscrire</button>  
        </form>

    </div>
 
</div> 
<?php 
$content = ob_get_clean();
require_once("base.php");
?>
