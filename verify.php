<?php
session_start();
include_once './functions/verify.php';
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <meta charset="UTF-8">
    <title>CAMAGRU - VERIFY</title>
  </header>
  <body>
    <?php include('header.php') ?>
    <?php include('footer.php') ?>
    <div id="login">
    <div class="title">VERIFY</div>
    <?php 
    if (verify($_GET["token"]) == 0)
        echo "Your account has been verified";
    else
        echo "Account not found" ?>
    </div>
  </body>
</HTML>
