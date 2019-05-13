<?php

function passres($user_email) {
    include_once '../config/database.php';
    include_once '../functions/mail.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT id, username FROM users WHERE mail=:mail AND statusvar='Y'");
        $user_email = strtolower($user_email);
        $stmt->execute(array(':mail' => $user_email));

        $val = $stmt->fetch();
        if ($val == null) {
            $stmt->closeCursor();
            return (-1);
        }
        $stmt->closeCursor();

        $pass = uniqid('');
        $p_encr = hash("whirlpool", $pass);

        $stmt = $condb->prepare("UPDATE users SET password=:password WHERE mail=:mail");
        $stmt->execute(array(':password' => $p_encr, ':mail' => $user_email));
        $stmt->closeCursor();

        sendrestoremail($user_email, $val['username'], $pass);
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

?>
