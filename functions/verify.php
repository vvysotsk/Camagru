<?php

function verify($token) {
  include_once './config/database.php';

try {
    $dbh = new PDO($dbdsn, $user, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query= $dbh->prepare("SELECT id FROM users WHERE token=:token");
    $query->execute(array(':token' => $token));

    $val = $query->fetch();
    if ($val == null) {
        return (-1);
    }
    $query->closeCursor();
    $query= $dbh->prepare("UPDATE users SET verified='Y' WHERE id=:id");
    $query->execute(array('id' => $val['id']));
    $query->closeCursor();
    return (0);
  } catch (PDOException $e) {
    return (-2);
  }
}
?>
