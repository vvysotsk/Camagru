#!/usr/bin/php
<?php
include 'database.php';

try {//DROP DATABASE
        $dbh = new PDO($dbdsnlight, $user, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DROP DATABASE `".$dbname."`";
        $dbh->exec($sql);
        echo "Database droped\n";
    } catch (PDOException $e) {
        echo "ERROR: \n".$e->getMessage()."<br/>";
    }
?>
