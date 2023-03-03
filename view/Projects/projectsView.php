<?php
    if(!empty($_SESSION["id"])){
        $user=Checker::getLoginAndRank($_SESSION["id"]);
    }
    $title = "Acceuil";
    ob_start();
?>
<div class="my-5">
    <h1> Projets </h1>
<?php 
    if (isset($_GET["success"])){
    if ($_GET["success"] == 1) { ?>

        <p class="card m-2 p-1 bg-success d-inline-block"><?=$_GET["message"] ?></p>  
<?php }
}                          
    while($project = $requete->fetch()) {   
    $author = Checker::getAuthor("projects", $project['id_user'])         
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
            <p class="card-subtitle">
               
            </p>
        </div>
        <!-- plus tard reserver a l'admin -->        

        <div class="card-footer">
            <div class="row">
                <div class="col-6">
                    <p>Ecrit par : <span class="fw-bold <?= Checker::colorMyRank($author['rank']) ?>"><?= $author['login'] ?></span> <br>
                    <i>Le : <?= DateToFr::dateFR($project['date']) ?></i></p>
                </div>
            <?php if (!empty($user['rank'])){ if ($user['rank'] == "admin"){ ?>    
                <form  class="col-6" method="get" action="index.php">
                    <button class="btn btn-danger mb-3" type="submit" name="deleteId" id="deleteId" value="<?= $project["id"] ?>" >Supprimer</button>
                    <button class="btn btn-success mb-3" type="submit" name="updateId" id="updateId" value="<?= $project["id"] ?>" >Modifier</button>
                </form>
            <?php } }?>
            </div>          
        </div> 
    </div>  
 
<?php   
}if (!empty($user['rank'])){
if ($user['rank'] == "admin"){
?>    
    <p> <a class="btn btn-primary mt-3" href="index?page=createProject">Creer un Projet</a></p>
</div> 

<?php }}
$content = ob_get_clean();
require_once("../view/base.php");
?>

