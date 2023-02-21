<?php
require_once('Manager.php');

class Checker extends Manager
{

  public static function getAuthor($table, $id_user)
  {
    $bdd = new Manager;
    $request = $bdd->connection();
    $result = $request->query(' SELECT users.login, users.rank FROM users INNER JOIN ' . $table . ' ON users.id = ' . $id_user);
    $author = $result->fetch(PDO::FETCH_ASSOC);
    return $author;
  }

  public static function colorMyRank($rank)
  {
    return ($rank === 'admin') ? 'text-danger' : 'text-primary';
  }

  public static function articleGotComs($id_article)
  {
    $bdd = new Manager;
    $request = $bdd->connection();
    $result = $request->query('SELECT * FROM commentaries WHERE id_article= ' . $id_article);
    $count = $result->rowCount();

    return $count;
  }

  public static function controls($id_user, $id_artOrCom, $content, $isArticle=false)
  {
    if (isset($_SESSION['id'])) {
      $id = $_SESSION['id'];
      if ($id === $id_user) { ?>
        <!-- Dropdown (liste déroulante) -->
        <div class="dropdown ">
          <!-- Bouton -->
          <button id="myButton" class="btn" type="button" data-bs-toggle="dropdown">
            <i class="fa-sharp fa-solid fa-gear" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"></i>
          </button>

          <!-- Les éléments du menu -->
          <ul class="dropdown-menu p-0" aria-labbeledby="myButton">
          <?php  if($isArticle === true) { ?>
            <li><a class="btn btn-warning border border-bottom-5 rounded-0 rounded-top w-100" href="index.php?page=modifier-article">Modifier l'article</a></li>
         <?php } else { ?>
            
            <li><button type="button" class="update btn btn-warning border border-bottom-5 rounded-0 rounded-top w-100 " data-bs-toggle="modal" data-bs-target="#update-<?=$id_artOrCom?>">Modifier commentaire</button></li>
          <?php } ?>
            <li><button type="button" class="btn btn-danger border rounded-0 rounded-bottom w-100" data-bs-toggle="modal" data-bs-target="#delete-<?=$id_artOrCom?>">
          Supprimer
        </button></li>
            
          </ul>
        </div>
        <?php if (!$isArticle) { ?>
          <!-- Modale modification-->
          <div class="modal fade" id="update-<?=$id_artOrCom?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                
                <!-- Header -->
                <div class="modal-header">
                  <h5 class="modal-title">Modifier commentaire :</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                  </div>
                  
                  <!-- Body -->
                  <div class="modal-body">
                    <textarea name="content-<?=$id_artOrCom?>" class="form-control"><?=$content ?></textarea>
                  </div>
                  
                  <!-- Footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" name="confirm" value="confirm-<?=$id_artOrCom?>" class="btn btn-warning">Modifier</button>
                  </div>

            </div>
          </div>
        </div>
      <?php } ?>
        <!-- Modale suppression-->
        <div class="modal fade" id="delete-<?=$id_artOrCom?>" data-bs-backdrop="static">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <!-- Header -->
              <div class="modal-header">
                <h5 class="modal-title">Supprimer ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
              </div>

              <!-- Body -->
              <div class="modal-body">
                <p class="m-0">Etes-vous sûr de vous ?</p>
              </div>

              <!-- Footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="delete" value="content-". <?=$id_artOrCom?> class="btn btn-danger">Supprimer</button>
              </div>

            </div>
          </div>
        </div>
<?php }
    }
  }
}
