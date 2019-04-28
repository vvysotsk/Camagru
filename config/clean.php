#!/usr/bin/php
<?php
include 'database.php';

try {//CLEAN ALL
        $dbh = new PDO($dbdsn, $user, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM `comment`";
        $dbh->exec($sql);

        $sql = "DELETE FROM `like`";
        $dbh->exec($sql);

        $sql = "DELETE FROM `gallery`";
        $dbh->exec($sql);

        array_map('unlink', glob("../assembly/*.png"));
        echo "Tables are cleaned\n";
    } catch (PDOException $e) {
        echo "ERROR: \n".$e->getMessage()."<br/>";
    }
?>
