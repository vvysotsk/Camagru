#!/usr/bin/php
<?php
include 'database.php';

try {//DATABASE
    $condb = new PDO($dbdsnlight, $user, $dbpass);

    $sql = "CREATE DATABASE `" . $dbname . "`";
    $condb->exec($sql);
    echo "Database created\n";
} catch (PDOException $e) {
    echo "ERROR#3: \n" . $e->getMessage() . "<br/>";
    die();
}

try {//TABLE USERS
    $condb = new PDO($dbdsn, $user, $dbpass, $option);

    $sql = "CREATE TABLE IF NOT EXISTS `users` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `username` VARCHAR(50) NOT NULL,
          `mail` VARCHAR(100) NOT NULL,
          `password` VARCHAR(255) NOT NULL,
          `uniqident` VARCHAR(50) NOT NULL,
          `statusvar` VARCHAR(1) NOT NULL DEFAULT 'N'
        )";
    $condb->exec($sql);
    echo "Table users created\n";
} catch (PDOException $e) {
    echo "ERROR#4: \n" . $e->getMessage() . "<br/>";
}

try {//TABLE GALLERY
    $condb = new PDO($dbdsn, $user, $dbpass, $option);

    $sql = "CREATE TABLE IF NOT EXISTS `gallery` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `usnubm` INT(11) NOT NULL,
          `img` VARCHAR(100) NOT NULL,
          FOREIGN KEY (usnubm) REFERENCES users(id)
        )";
    $condb->exec($sql);
    echo "Table gallery created\n";
} catch (PDOException $e) {
    echo "ERROR#5: \n" . $e->getMessage() . "<br/>";
}

try {//TABLE LIKE
    $condb = new PDO($dbdsn, $user, $dbpass, $option);

    $sql = "CREATE TABLE IF NOT EXISTS `like` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `usnubm` INT(11) NOT NULL,
          `picident` INT(11) NOT NULL,
          `type` VARCHAR(1) NOT NULL,
          FOREIGN KEY (usnubm) REFERENCES users(id),
          FOREIGN KEY (picident) REFERENCES gallery(id)
        )";
    $condb->exec($sql);
    echo "Table like created\n";
} catch (PDOException $e) {
    echo "ERROR#6: \n" . $e->getMessage() . "<br/>";
}

try {//TABLE COMMENT
    $condb = new PDO($dbdsn, $user, $dbpass, $option);

    $sql = "CREATE TABLE IF NOT EXISTS `comment` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `usnubm` INT(11) NOT NULL,
          `picident` INT(11) NOT NULL,
          `comment` VARCHAR(255) NOT NULL,
          FOREIGN KEY (usnubm) REFERENCES users(id),
          FOREIGN KEY (picident) REFERENCES gallery(id)
        )";
    $condb->exec($sql);
    echo "Table comment created\n";
} catch (PDOException $e) {
    echo "ERROR#7: \n" . $e->getMessage() . "<br/>";
}
?>
