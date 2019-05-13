<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
    <header>
        <meta charset="UTF-8">
        <title>CAMAGRU - FORGOT</title>
        <link rel="stylesheet" type="text/css" href="style/index.css">
    </header>
    <body>
        <?php
        include('header.php');
        include('footer.php');
        ?>
        <div id="login">
            <div class="log">RESTORE</div>
            <div id="luftw">
                <form action="framework/restore.php" method="post" style="position: relative;" >
                    <label>Email: </label>
                    <input placeholder="email" id="mail" type="mail" name="email">
                    <input value=" SEND " name="submit" type="submit">
                </form>
            </div>
            <?php
            echo $_SESSION['error'];
            $_SESSION['error'] = null;
            ?> <div class="idk"></div> <?php
            if (isset($_SESSION['restore_success'])) {
                echo "An email has been sent to your email address";
                $_SESSION['restore_success'] = null;
            }
            ?>
        </div>
    </body>
</HTML>
