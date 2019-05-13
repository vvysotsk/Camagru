<?php
session_start();
include_once './functions/verify.php';
?>
<!DOCTYPE html>
<HTML>
    <header>
        <meta charset="UTF-8">
        <title>CAMAGRU - VERIFY</title>
        <link rel="stylesheet" type="text/css" href="style/index.css">
    </header>
    <body>
        <?php
        include('header.php');
        include('footer.php');
        ?>
        <div id="login">
            <div class="log">VERIFY</div>
            <?php
            if (verify($_GET["uniqident"]) == 0)
                echo "Your account has been verified";
            else
                echo "Account not found"
                ?>
        </div>
    </body>
</HTML>
