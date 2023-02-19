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

  public static function controls($id_user)
  {
    if (isset($_SESSION['id'])) {
      $id = $_SESSION['id'];
      if ($id === $id_user) { ?>
        <div class="border update btn">
          <i class="fa-sharp fa-solid fa-gear" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"></i>
        </div>
<?php }
    }
  }
}
