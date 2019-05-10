<?php

function signup($mail, $username, $userpass, $host) {
  include_once '../config/database.php';
  include_once '../functions/mail.php';

  $mail = strtolower($mail);
  try {
          $condb = new PDO($dbdsn, $user, $dbpass);
          $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $query= $condb->prepare("SELECT id FROM users WHERE username=:username OR mail=:mail");
          $query->execute(array(':username' => $username, ':mail' => $mail));

          if ($val = $query->fetch()) {
            $_SESSION['error'] = "user already exist";
            $query->closeCursor();
            return(-1);
          }
          $query->closeCursor();

          $userpass = hash("whirlpool", $userpass);
          $query= $condb->prepare("INSERT INTO users (username, mail, password, token) VALUES (:username, :mail, :password, :token)");
          $chusid = uniqid(rand(), true);
          $query->execute(array(':username' => $username, ':mail' => $mail, ':password' => $userpass, ':token' => $chusid));
          sendverificationemail($mail, $username, $chusid, $host);
          $_SESSION['signup_success'] = true;
          return (0);
      } catch (PDOException $e) {
          $_SESSION['error'] = "ERROR: ".$e->getMessage();
      }
}
?>
