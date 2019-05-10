<?php

function addlassembl($userId, $imgPath) {
  include_once '../config/database.php';

  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
      $query->execute(array(':userid' => $userId, ':img' => $imgPath));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function getallassembl() {
  include_once './config/database.php';

  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT userid, img FROM gallery");
      $query->execute();

      $i = 0;
      $arasml = null;
      while ($val = $query->fetch()) {
        $arasml[$i] = $val;
        $i++;
      }
      $query->closeCursor();
      return ($arasml);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function remove_assembl($uid, $img) {
  include_once '../config/database.php';

  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT * FROM gallery WHERE img=:img AND userid=:userid");
      $query->execute(array(':img' => $img, ':userid' => $uid));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      $query= $condb->prepare("DELETE FROM `like` WHERE galleryid=:galleryid");
      $query->execute(array(':galleryid' => $val['id']));
      $query->closeCursor();

      $query= $condb->prepare("DELETE FROM comment WHERE galleryid=:galleryid");
      $query->execute(array(':galleryid' => $val['id']));
      $query->closeCursor();

      $query= $condb->prepare("DELETE FROM gallery WHERE img=:img AND userid=:userid");
      $query->execute(array(':img' => $img, ':userid' => $uid));
      $query->closeCursor();
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
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT userid, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
      $query->bindValue(':lim', $counter + 1, PDO::PARAM_INT);
      $query->bindValue(':id', $start, PDO::PARAM_INT);
      $query->execute();

      $i = 0;
      $arasml = null;
      while (($val = $query->fetch())) {
        if ($i >= $counter) {
          $arasml['more'] = true;
        } else {
          $arasml[$i] = $val;
        }
        $i++;
      }
      $query->closeCursor();
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
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT userid, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
      $query->bindValue(':lim', $counter + 1, PDO::PARAM_INT);
      $query->bindValue(':id', $start, PDO::PARAM_INT);
      $query->execute();

      $i = 0;
      $arasml = null;
      while (($val = $query->fetch())) {
        if ($i >= $counter) {
          $arasml['more'] = true;
        } else {
          $arasml[$i] = $val;
        }
        $i++;
      }
      $query->closeCursor();
      return ($arasml);
    } catch (PDOException $e) {
      $er['error'] = $e->getMessage();
      return ($er);
    }
}

function comment($uid, $imgSrc, $comtxt) {
  include_once '../config/database.php';

  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("INSERT INTO comment(userid, galleryid, comment) SELECT :userid, id, :comment FROM gallery WHERE img=:img");
      $query->execute(array(':userid' => $uid, ':comment' => $comtxt, ':img' => $imgSrc));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_comments($imgSrc) {
  include './config/database.php';

  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT c.comment, u.username FROM comment AS c, users AS u, gallery AS g WHERE g.img=:img AND g.id=c.galleryid AND c.userid=u.id");
      $query->execute(array(':img' => $imgSrc));

      $i = 0;
      $arasml = "";
      while ($val = $query->fetch()) {
        $arasml[$i] = $val;
        $i++;
      }
      $arasml[$i] = null;
      $query->closeCursor();
      return ($arasml);
    } catch (PDOException $e) {
      $keyr['error'] = $e->getMessage();
      return ($keyr);
    }
}

function inscomment($imgSrc) {
  include '../config/database.php';

  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT c.comment, u.username FROM comment AS c, users AS u, gallery AS g WHERE g.img=:img AND g.id=c.galleryid AND c.userid=u.id");
      $query->execute(array(':img' => $imgSrc));

      $i = 0;
      $arasml = "";
      while ($val = $query->fetch()) {
        $arasml[$i] = $val;
        $i++;
      }
      $arasml[$i] = null;
      $query->closeCursor();
      return ($arasml);
    } catch (PDOException $e) {
      $keyr['error'] = $e->getMessage();
      return ($keyr);
    }
}

function aseembluserinfo($imgSrc) {
  include '../config/database.php';

  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT mail, username FROM users, gallery WHERE gallery.img=:img AND users.id=gallery.userid");
      $query->execute(array(':img' => $imgSrc));

      $val = $query->fetch();
      $query->closeCursor();
      return ($val);
    } catch (PDOException $e) {
      $keyr['error'] = $e->getMessage();
      return ($keyr);
    }
}
?>
