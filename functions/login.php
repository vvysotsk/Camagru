<?php

function log_user($userMail, $userpass) {
  include_once '../config/database.php';

  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT id, username FROM users WHERE mail=:mail AND password=:password AND verified='Y'");
      $userMail = strtolower($userMail);
      $userpass = hash("whirlpool", $userpass);
      $query->execute(array(':mail' => $userMail, ':password' => $userpass));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();
      return ($val);
    } catch (PDOException $e) {
      $err['err'] = $e->getMessage();
      return ($err);
    }
}
?>
