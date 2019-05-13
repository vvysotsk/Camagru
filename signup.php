<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
    <header>
        <link rel="stylesheet" type="text/css" href="style/index.css">
        <title>SIGNUP</title>
        <meta charset="UTF-8">
    </header>
    <?php
    include('header.php');
    include('footer.php');
    ?>
    <div id="login">
        <div class="log">SIGNUP</div>
        <div id="luftw">
            <form action="framework/signup.php" method="post" style="position: relative;">
                <label>Email: </label>
                <div class="shok"></div>
                <input placeholder="email" id="mail" name="email" type="mail">
                <label>Username: </label>
                <div class="shok"></div>
                <input placeholder="username" id="name" name="username" type="text">
                <label>Password: </label>
                <div class="shok"></div>
                <input placeholder="password" id="password" name="password" type="password">
                <input name="submit" type="submit" value=" SEND ">
                <div class="shok"></div>
                <span>
                    <?php
                    echo $_SESSION['error'];
                    $_SESSION['error'] = null;
                    if (isset($_SESSION['signup_success'])) {
                        echo "Signup success please check your mail box";
                        $_SESSION['signup_success'] = null;
                    }
                    ?>
                </span>
            </form>
        </div>
    </div>
</body>
</HTML>
