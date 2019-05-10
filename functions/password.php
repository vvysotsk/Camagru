<?php

function passres($userMail) {
  include_once '../config/database.php';
  include_once '../functions/mail.php';

  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT id, username FROM users WHERE mail=:mail AND verified='Y'");
      $userMail = strtolower($userMail);
      $query->execute(array(':mail' => $userMail));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      $pass = uniqid('');
      $p_encr = hash("whirlpool", $pass);

      $query= $condb->prepare("UPDATE users SET password=:password WHERE mail=:mail");
      $query->execute(array(':password' => $p_encr, ':mail' => $userMail));
      $query->closeCursor();

      sendrestoremail($userMail, $val['username'], $pass);
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}
?>
