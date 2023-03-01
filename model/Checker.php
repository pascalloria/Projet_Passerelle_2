<?php
require_once("DataBaseManager.php");

class Checker extends DBManager
{

  public  static function getAuthor($table, $id_user)
  {
    $bdd = new DBManager;
    $request = $bdd->connection();
    $result = $request->query(' SELECT users.login, users.rank FROM users INNER JOIN ' . $table . ' ON users.id = ' . $id_user);
    $author = $result->fetch(PDO::FETCH_ASSOC);
    return $author;
  }

  public static function articleGotComs($id_article)
  {
    $bdd = new DBManager;
    $request = $bdd->connection();
    $result = $request->query('SELECT * FROM commentaries WHERE id_article= ' . $id_article);
    $count = $result->rowCount();

    return $count;
  }

  // la fonction suivante sert a verifier la présence d'un admin
  public static function getLoginAndRank($id)
  {
    $bdd = new Checker;
    $log = $bdd->connection();
    $user = $log->query("SELECT login, `rank` FROM users WHERE id=$id");
    $result = $user->fetch();
    return $result;
  }

  public static function colorMyRank($rank)
  {
    return ($rank === 'admin') ? 'text-danger' : 'text-primary';
  }

  public static function getMyScore($id_user) {
    $bdd = new Checker;
    $req = $bdd->connection();
    $coms = $req->query("SELECT * FROM commentaries WHERE id_user = $id_user");
    $result= $coms->rowCount() * 10;
    return $result;
  }
}
