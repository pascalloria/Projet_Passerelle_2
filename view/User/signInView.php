<?php
    $title = "Inscription";
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
    <div class=" containerCenter d-flex justify-content-center align-items-center">

        <div class="card p-3 bg-color2"> 
            <!-- En-tête de la carte -->
            <div class="card-header">
                <div class="card-title h2 text-center"> Inscription </div>
            </div>
            <!-- Corps -->
            <div class="card-body ">
            <form  class="form text-center " method="post" action=".?page=inscription">
                    <p class="row">
                        <label class="label col-5 fw-bol" for="login">Login :</label>
                        <input class="control-form col-7" type="text" name="login" id="login" placeholder="Entrer votre pseudo" required >
                    </p>

                    <p class="row">
                        <label class="label col-5 fw-bol" for="email">Email :</label>
                        <input class="control-form col-7" type="email" name="email" id="email" placeholder="Entrer un email valide" required>
                    </p>

                    <p class="row">
                        <label class="label col-5 fw-bol" for="password">Mot de passe :</label>
                        <input class="control-form col-7" type="password" name="password" id="password" required>                    
                    </p>
                    <p class="row">
                        <label class="label col-5 fw-bol" for="password">Verifier mot de passe :</label>
                        <input class="control-form col-7" type="password" name="password_two" id="password_two" required>
                    </p>
                    <button class="btn text-bg-dark rounded-3 p-2  type="submit">S'inscrire</button>  
                </form>
            </div>

                
            
        </div>

    </div>
 
</div> 
<?php 
$content = ob_get_clean();
require_once("../view/base.php");
?>
