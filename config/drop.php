#!/usr/bin/php
<?php
include 'database.php';

try {//DROP DATABASE
    $condb = new PDO($dbdsnlight, $user, $dbpass);

    $sql = "DROP DATABASE `" . $dbname . "`";
    $condb->exec($sql);
    echo "Database droped\n";
} catch (PDOException $e) {
    echo "ERROR#2: \n" . $e->getMessage() . "<br/>";
}
?>
