<?php

function signup($mail, $username, $userpass, $host) {
    include_once '../config/database.php';
    include_once '../functions/mail.php';

    $mail = strtolower($mail);
    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT id FROM users WHERE username=:username OR mail=:mail");
        $stmt->execute(array(':username' => $username, ':mail' => $mail));
        if ($val = $stmt->fetch()) {
            $_SESSION['error'] = "user already exist";
            $stmt->closeCursor();
            return(-1);
        }
        $stmt->closeCursor();

        $userpass = hash("whirlpool", $userpass);
        $stmt = $condb->prepare("INSERT INTO users (username, mail, password, uniqident) VALUES (:username, :mail, :password, :uniqident)");
        $chusid = uniqid(rand(), true);
        $stmt->execute(array(':username' => $username, ':mail' => $mail, ':password' => $userpass, ':uniqident' => $chusid));
        sendverificationemail($mail, $username, $chusid, $host);
        $_SESSION['signup_success'] = true;
        return (0);
    } catch (PDOException $e) {
        $_SESSION['error'] = "ERROR: " . $e->getMessage();
    }
}

?>
