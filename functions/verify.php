<?php

function verify($chusid) {
  include_once './config/database.php';

try {
    $condb = new PDO($dbdsn, $user, $dbpass);
    $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query= $condb->prepare("SELECT id FROM users WHERE token=:token");
    $query->execute(array(':token' => $chusid));

    $val = $query->fetch();
    if ($val == null) {
        return (-1);
    }
    $query->closeCursor();
    $query= $condb->prepare("UPDATE users SET verified='Y' WHERE id=:id");
    $query->execute(array('id' => $val['id']));
    $query->closeCursor();
    return (0);
  } catch (PDOException $e) {
    return (-2);
  }
}
?>
