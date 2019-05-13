#!/usr/bin/php
<?php
include 'database.php';

try {//CLEAN ALL
    $condb = new PDO($dbdsn, $user, $dbpass, $option);

    $sql = "DELETE FROM `comment`";
    $condb->exec($sql);

    $sql = "DELETE FROM `like`";
    $condb->exec($sql);

    $sql = "DELETE FROM `gallery`";
    $condb->exec($sql);

    array_map('unlink', glob("../assembly/*.png"));
    echo "Tables are cleaned\n";
} catch (PDOException $e) {
    echo "ERROR#1: \n" . $e->getMessage() . "<br/>";
}
?>
