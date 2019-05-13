<?php

function log_user($user_email, $userpass) {
    include_once '../config/database.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);

        $stmt = $condb->prepare("SELECT id, username FROM users WHERE mail=:mail AND password=:password AND statusvar='Y'");
        $user_email = strtolower($user_email);
        $userpass = hash("whirlpool", $userpass);
        $stmt->execute(array(':mail' => $user_email, ':password' => $userpass));

        $val = $stmt->fetch();
        if ($val == null) {
            $stmt->closeCursor();
            return (-1);
        }
        $stmt->closeCursor();
        return ($val);
    } catch (PDOException $e) {
        $err['err'] = $e->getMessage();
        return ($err);
    }
}

?>
