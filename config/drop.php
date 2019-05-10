#!/usr/bin/php
<?php
include 'database.php';

try {//DROP DATABASE
        $condb = new PDO($dbdsnlight, $user, $dbpass);
        $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DROP DATABASE `".$dbname."`";
        $condb->exec($sql);
        echo "Database droped\n";
    } catch (PDOException $e) {
        echo "ERROR: \n".$e->getMessage()."<br/>";
    }
?>
