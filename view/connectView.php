<?php
    $title = "Connection";
    ob_start();
?>
<div class="my-5 w-50 mx-auto">    
<?php 
    if (isset($_GET["success"])){
    if ($_GET["success"] == 1) { ?>

        <p class="card m-2 p-1 bg-success d-inline-block"><?=$_GET["message"] ?></p>  
    
<?php }
} 
if (isset($_GET["error"])){
    if ($_GET["error"] == 1) { ?>

        <p class="card m-2 p-1 bg-danger d-inline-block"><?=$_GET["message"] ?></p>  

<?php }
}
?>
    <div class="">

    
        <form  class="form " method="post" action=".?page=connect">

            <p>
                <label class="label" for="login">Login</label>
                <input class="control-form-sm" type="text" name="login" id="login" placeholder="Entrer votre pseudo" required >
            </p>
         

            <p>
                <label class="label" for="password">Mot de pass</label>
                <input class="control-form-sm" type="password" name="password" id="password" placeholder="Entrer votre mot de passe" required>
                
            </p>

            <button type="submit">Se connecter</button>  
        </form>

    </div>
 
</div> 
<?php 
$content = ob_get_clean();
require_once("base.php");
?>
