<?php

function addlike($uid, $img, $ldval) {
    include '../config/database.php';
    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("INSERT INTO `like`(usnubm, picident, type) SELECT :usnubm, id, :type FROM gallery WHERE img=:img");
        $stmt->execute(array(':usnubm' => $uid, ':img' => $img, ':type' => $ldval));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function updatelike($uid, $img, $ldval) {
    include '../config/database.php';
    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("UPDATE `like`, gallery SET `like`.type=:type WHERE gallery.img=:img AND gallery.usnubm=:usnubm AND `like`.picident=gallery.id");
        $stmt->execute(array(':usnubm' => $uid, ':img' => $img, ':type' => $ldval));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function getlike($uid, $img) {
    include '../config/database.php';
    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.usnubm=:usnubm AND `like`.picident=gallery.id AND gallery.img=:img");
        $stmt->execute(array(':usnubm' => $uid, ':img' => $img));
        $val = $stmt->fetch();
        $stmt->closeCursor();
        return ($val);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function getlikenb($img) {
    include './config/database.php';
    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.picident=gallery.id AND gallery.img=:img AND `like`.type='L'");
        $stmt->execute(array(':img' => $img));

        $count = 0;
        while ($val = $stmt->fetch()) {
            $count++;
        }
        $stmt->closeCursor();
        return ($count);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function likecount($img) {
    include '../config/database.php';
    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.picident=gallery.id AND gallery.img=:img AND `like`.type='L'");
        $stmt->execute(array(':img' => $img));

        $count = 0;
        while ($val = $stmt->fetch()) {
            $count++;
        }
        $stmt->closeCursor();
        return ($count);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function getdislnb($img) {
    include './config/database.php';
    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.picident=gallery.id AND gallery.img=:img AND `like`.type='D'");
        $stmt->execute(array(':img' => $img));

        $count = 0;
        while ($val = $stmt->fetch()) {
            $count++;
        }
        $stmt->closeCursor();
        return ($count);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function dislcount($img) {
    include '../config/database.php';
    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.picident=gallery.id AND gallery.img=:img AND `like`.type='D'");
        $stmt->execute(array(':img' => $img));

        $count = 0;
        while ($val = $stmt->fetch()) {
            $count++;
        }
        $stmt->closeCursor();
        return ($count);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

?>
