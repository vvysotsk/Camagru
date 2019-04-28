<?php

function log_user($userMail, $password) {
  include_once '../config/database.php';

  try {
      $dbh = new PDO($dbdsn, $user, $dbpass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT id, username FROM users WHERE mail=:mail AND password=:password AND verified='Y'");
      $userMail = strtolower($userMail);
      $password = hash("whirlpool", $password);
      $query->execute(array(':mail' => $userMail, ':password' => $password));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      return ($val);
    } catch (PDOException $e) {
      $v['err'] = $e->getMessage();
      return ($v);
    }
}

?>
