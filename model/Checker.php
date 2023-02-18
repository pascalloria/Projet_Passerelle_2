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

    public static function colorMyRank($rank) {
      return ($rank === 'admin') ? 'text-danger' : 'text-primary';  
    }
}
