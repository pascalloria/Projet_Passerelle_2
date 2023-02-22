<?php
    $title = "Acceuil";
    ob_start();
?>
<div class="my-5">
    <h2 class="text-center"> Projets </h2>
<?php 
    if (isset($_GET["success"])){
    if ($_GET["success"] == 1) { ?>

        <p class="card m-2 p-1 bg-success d-inline-block"><?=$_GET["message"] ?></p>  
<?php }
}                          
    while($project = $requete->fetch()) {            
?>
    <div class="card mt-4">
    
    <?php if (!empty($project["img"])){ ?>

        <div class="item-center"><img class="card-img-top mx-auto" src="src/img/<?=$project["img"] ?>" alt="Image of project"></div>
    <?php } ?> 

        <div class="card-header">
            <b><?= $project['title'] ?></b>
        </div>
        <div class="card-body">


            <p class="card-text"> <?=$project["content"] ?></p>                   
            <p class="card-subtitle"><i>Par<b> <?=$project["id_user"] ?></b> , crée le <?=DateToFr::dateFR($project["date"]) ?></i> </p>
        </div>
        <!-- plus tard reserver a l'admin -->        

        <div class="card-footer">
            <form method="get" action="index.php">
                <button class="btn btn-danger mb-3" type="submit" name="deleteId" id="deleteId" value="<?= $project["id"] ?>" >Supprimer</button>
                <button class="btn btn-success mb-3" type="submit" name="updateId" id="updateId" value="<?= $project["id"] ?>" >Modifier</button>
            </form>           
        </div> 
    </div>  
 
<?php   
}
?>    
    <p> <a class="btn btn-primary mt-3" href="index?page=createProject">Creer un Projet</a></p>
</div> 
<?php 
$content = ob_get_clean();
require_once("base.php");
?>


