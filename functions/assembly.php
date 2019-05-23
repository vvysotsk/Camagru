<?php

function addlassembl($usnubm, $imgPath) {
    include_once '../config/database.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("INSERT INTO gallery (usnubm, img) VALUES (:usnubm, :img)");
        $stmt->execute(array(':usnubm' => $usnubm, ':img' => $imgPath));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function getallassembl() {
    include_once './config/database.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT usnubm, img FROM gallery");
        $stmt->execute();

        $i = 0;
        $arasml = null;
        while ($val = $stmt->fetch()) {
            $arasml[$i] = $val;
            $i++;
        }
        $stmt->closeCursor();
        return ($arasml);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function remove_assembl($uid, $img) {
    include_once '../config/database.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT * FROM gallery WHERE img=:img AND usnubm=:usnubm");
        $stmt->execute(array(':img' => $img, ':usnubm' => $uid));

        $val = $stmt->fetch();
        if ($val == null) {
            $stmt->closeCursor();
            return (-1);
        }
        $stmt->closeCursor();

        $stmt = $condb->prepare("DELETE FROM `like` WHERE picident=:picident");
        $stmt->execute(array(':picident' => $val['id']));
        $stmt->closeCursor();

        $stmt = $condb->prepare("DELETE FROM comment WHERE picident=:picident");
        $stmt->execute(array(':picident' => $val['id']));
        $stmt->closeCursor();

        $stmt = $condb->prepare("DELETE FROM gallery WHERE img=:img AND usnubm=:usnubm");
        $stmt->execute(array(':img' => $img, ':usnubm' => $uid));
        $stmt->closeCursor();
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function get_assemblpic($start, $counter) {
    include_once './config/database.php';

    try {
        if ($start < 0) {
            $start = 0;
        }
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT usnubm, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
        $stmt->bindValue(':lim', $counter + 1, PDO::PARAM_INT);
        $stmt->bindValue(':id', $start, PDO::PARAM_INT);
        $stmt->execute();

        $i = 0;
        $arasml = null;
        while (($val = $stmt->fetch())) {
            if ($i >= $counter) {
                $arasml['more'] = true;
            } else {
                $arasml[$i] = $val;
            }
            $i++;
        }
        $stmt->closeCursor();
        return ($arasml);
    } catch (PDOException $e) {
        $er['error'] = $e->getMessage();
        return ($er);
    }
}

function insasmblpic($start, $counter) {
    include_once '../config/database.php';

    try {
        if ($start < 0) {
            $start = 0;
        }
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT usnubm, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
        $stmt->bindValue(':lim', $counter + 1, PDO::PARAM_INT);
        $stmt->bindValue(':id', $start, PDO::PARAM_INT);
        $stmt->execute();

        $i = 0;
        $arasml = null;
        while (($val = $stmt->fetch())) {
            if ($i >= $counter) {
                $arasml['more'] = true;
            } else {
                $arasml[$i] = $val;
            }
            $i++;
        }
        $stmt->closeCursor();
        return ($arasml);
    } catch (PDOException $e) {
        $er['error'] = $e->getMessage();
        return ($er);
    }
}

function comment($uid, $imgSrc, $comtxt) {
    include_once '../config/database.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("INSERT INTO comment(usnubm, picident, comment) SELECT :usnubm, id, :comment FROM gallery WHERE img=:img");
        $stmt->execute(array(':usnubm' => $uid, ':comment' => $comtxt, ':img' => $imgSrc));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}

function get_comments($imgSrc) {
    include './config/database.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT c.comment, u.username FROM comment AS c, users AS u, gallery AS g WHERE g.img=:img AND g.id=c.picident AND c.usnubm=u.id");
        $stmt->execute(array(':img' => $imgSrc));

        $i = 0;
        $arasml = [];
        while ($val = $stmt->fetch()) {
            $arasml[$i] = $val;
            $i++;
        }
        $stmt->closeCursor();
        return ($arasml);
    } catch (PDOException $e) {
        $keyr['error'] = $e->getMessage();
        return ($keyr);
    }
}

function inscomment($imgSrc) {
    include '../config/database.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT c.comment, u.username FROM comment AS c, users AS u, gallery AS g WHERE g.img=:img AND g.id=c.picident AND c.usnubm=u.id");
        $stmt->execute(array(':img' => $imgSrc));

        $i = 0;
        $arasml = [];
        while ($val = $stmt->fetch()) {
            $arasml[$i] = $val;
            $i++;
        }
        $arasml[$i] = null;
        $stmt->closeCursor();
        return ($arasml);
    } catch (PDOException $e) {
        $keyr['error'] = $e->getMessage();
        return ($keyr);
    }
}

function aseembluserinfo($imgSrc) {
    include '../config/database.php';

    try {
        $condb = new PDO($dbdsn, $user, $dbpass, $option);
        $stmt = $condb->prepare("SELECT mail, username FROM users, gallery WHERE gallery.img=:img AND users.id=gallery.usnubm");
        $stmt->execute(array(':img' => $imgSrc));

        $val = $stmt->fetch();
        $stmt->closeCursor();
        return ($val);
    } catch (PDOException $e) {
        $keyr['error'] = $e->getMessage();
        return ($keyr);
    }
}

?>
