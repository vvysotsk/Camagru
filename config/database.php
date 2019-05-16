<?php

$dbname = "camagru";
$dbdsn = "mysql:host=localhost;dbname=".$dbname.";port=3306;charset=utf8;";
$dbdsnlight = "mysql:host=localhost;";
$user = "admin";
$dbpass = "";
$option = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
?>
