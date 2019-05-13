<?php

$dbname = "camagru";
$dbdsn = "mysql:host=127.0.0.1;dbname=" . $dbname;
$dbdsnlight = "mysql:host=127.0.0.1";
$user = "root";
$dbpass = "";
$option = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
?>
