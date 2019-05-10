#!/usr/bin/php
<?php
include 'database.php';

try {//DATABASE
        $condb = new PDO($dbdsnlight, $user, $dbpass);
        $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE `".$dbname."`";
        $condb->exec($sql);
        echo "Database created\n";
    } catch (PDOException $e) {
        echo "ERROR: \n".$e->getMessage()."<br/>";
        die();
    }
    
try {//TABLE USERS
        $condb = new PDO($dbdsn, $user, $dbpass);
        $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `users` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `username` VARCHAR(50) NOT NULL,
          `mail` VARCHAR(100) NOT NULL,
          `password` VARCHAR(255) NOT NULL,
          `token` VARCHAR(50) NOT NULL,
          `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
        )";
        $condb->exec($sql);
        echo "Table users created\n";
    } catch (PDOException $e) {
        echo "ERROR: \n".$e->getMessage()."<br/>";
    }
    
try {//TABLE GALLERY
        $condb = new PDO($dbdsn, $user, $dbpass);
        $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `gallery` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `img` VARCHAR(100) NOT NULL,
          FOREIGN KEY (userid) REFERENCES users(id)
        )";
        $condb->exec($sql);
        echo "Table gallery created\n";
    } catch (PDOException $e) {
        echo "ERROR: \n".$e->getMessage()."<br/>";
    }

try {//TABLE LIKE
        $condb = new PDO($dbdsn, $user, $dbpass);
        $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `like` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `galleryid` INT(11) NOT NULL,
          `type` VARCHAR(1) NOT NULL,
          FOREIGN KEY (userid) REFERENCES users(id),
          FOREIGN KEY (galleryid) REFERENCES gallery(id)
        )";
        $condb->exec($sql);
        echo "Table like created\n";
    } catch (PDOException $e) {
        echo "ERROR: \n".$e->getMessage()."<br/>";
    }

try {//TABLE COMMENT
        $condb = new PDO($dbdsn, $user, $dbpass);
        $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `comment` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `galleryid` INT(11) NOT NULL,
          `comment` VARCHAR(255) NOT NULL,
          FOREIGN KEY (userid) REFERENCES users(id),
          FOREIGN KEY (galleryid) REFERENCES gallery(id)
        )";
        $condb->exec($sql);
        echo "Table comment created\n";
    } catch (PDOException $e) {
        echo "ERROR: \n".$e->getMessage()."<br/>";
    }
?>
