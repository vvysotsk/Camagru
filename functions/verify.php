<?php

function verify($chusid) {
    include_once './config/database.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT id FROM users WHERE uniqident=:uniqident");
        $stmt->execute(array(':uniqident' => $chusid));

        $val = $stmt->fetch();
        if ($val == null):
            return (-1);
        endif;
        $stmt->closeCursor();
        $stmt = $condb->prepare("UPDATE users SET statusvar='Y' WHERE id=:id");
        $stmt->execute(array('id' => $val['id']));
        $stmt->closeCursor();
        return (0);
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage() . "";
        die;
    }
}

?>
