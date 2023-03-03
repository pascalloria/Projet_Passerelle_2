<?php
$title = "Administration";

ob_start();

?>
<div class="my-5">
    <h1 class="mt-3"> Liste des utilisateurs </h1>

    <table class="table table-sm table-bordered border-danger mt-3">
    <tr class="table-success">
        <th>
            Login
        </th>
        <th>
            Email
        </th>
        <th>
            Rang
        </th>
        <th>
            action
        </th>
    </tr>

<?php
    // Liste des utilisateurs

    while ($res = $request->fetch()){ 

?>
    
        <tr class="bg-color2">
            <td>
                <?= $res["login"]?>
            </td>
            <td>
                <?= $res["email"]?>
            </td>
            <td>
                <?= $res["rank"]?>
            </td>
            <td>
                <div class="btn-group">
                    <!-- Passer admin -->
                    <form method="POST"  action="index.php?page=admin">
                        <button type="submit" name="promote" id="promote" value="<?= $res["id"] ?>" >Promouvoir</button>
                    </form>
                    <!-- Passer user -->
                    <form method="POST"  action="index.php?page=admin">
                        <button type="submit" name="demote" id="demote" value="<?= $res["id"] ?>" >utilisateur</button>
                    </form>
                    <!-- Supprimer l'utilisateur de la base de donnée -->
                    <form method="POST"  action="index.php?page=admin">
                        <button type="submit" name="delete" id="delete" value="<?= $res["id"] ?>" >Supprimer</button>
                    </form>                    
                    <!-- Supprimer toute les contributions de l'utilisateur de la base de donnée -->
                    <form method="POST"  action="index.php?page=admin">
                        <button type="submit" name="erase" id="erase" value="<?= $res["id"] ?>" >Effacer</button>
                    </form>                    
                </div>
                
            </td>
        </tr>
         
<?php
} 
?>

    </table>
</div>
<?php
$content = ob_get_clean();
require('../view/base.php');