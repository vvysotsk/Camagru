<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
    <header>
        <meta charset="UTF-8">
        <title>CAMAGRU</title>
        <link rel="stylesheet" type="text/css" href="style/index.css">
    </header>
    <body>
        <?php
        include('header.php');
        include('footer.php');
        ?>
        <div id="login">
            <div class="log">LOGIN</div>
            <div id="luftw">
                <?php
                if (isset($_SESSION['id'])) {
                    echo "You are connected as " . htmlspecialchars($_SESSION['username']);
                } else {
                    ?>
                    <form action="framework/login.php" method="post" style="position: relative;">
                        <label>Email: </label>
                        <input placeholder="email" id="mail" name="email" type="mail">
                        <label>Password: </label>
                        <input placeholder="password" id="password" name="password" type="password">
                        <input name="submit" type="submit" value=" SEND ">
                        <div class="nothing"></div>
                        <a href="signup.php">Create account</a>
                        <a href="restore.php">Forget password ?</a>
                        <span>
                            <?php
                            if ($_SESSION['error']) {
                                echo $_SESSION['error'];
                            }
                            $_SESSION['error'] = null;
                            ?>
                        </span>
                    </form>
                <?php } ?>
            </div>
        </div>
    </body>
</HTML>
