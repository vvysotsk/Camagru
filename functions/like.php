<?php
function addlike($uid, $img, $ldval) {
  include '../config/database.php';
  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("INSERT INTO `like`(userid, galleryid, type) SELECT :userid, id, :type FROM gallery WHERE img=:img");
      $query->execute(array(':userid' => $uid, ':img' => $img, ':type' => $ldval));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function updatelike($uid, $img, $ldval) {
  include '../config/database.php';
  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("UPDATE `like`, gallery SET `like`.type=:type WHERE gallery.img=:img AND gallery.userid=:userid AND `like`.galleryid=gallery.id");
      $query->execute(array(':userid' => $uid, ':img' => $img, ':type' => $ldval));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function getlike($uid, $img) {
  include '../config/database.php';
  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.userid=:userid AND `like`.galleryid=gallery.id AND gallery.img=:img");
      $query->execute(array(':userid' => $uid, ':img' => $img));
      $val = $query->fetch();
      $query->closeCursor();
      return ($val);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function getlikenb($img) {
  include './config/database.php';
  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.galleryid=gallery.id AND gallery.img=:img AND `like`.type='L'");
      $query->execute(array(':img' => $img));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function likecount($img) {
  include '../config/database.php';
  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.galleryid=gallery.id AND gallery.img=:img AND `like`.type='L'");
      $query->execute(array(':img' => $img));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function getdislnb($img) {
  include './config/database.php';
  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.galleryid=gallery.id AND gallery.img=:img AND `like`.type='D'");
      $query->execute(array(':img' => $img));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function dislcount($img) {
  include '../config/database.php';
  try {
      $condb = new PDO($dbdsn, $user, $dbpass);
      $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $condb->prepare("SELECT type FROM `like`, gallery WHERE `like`.galleryid=gallery.id AND gallery.img=:img AND `like`.type='D'");
      $query->execute(array(':img' => $img));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}
?>
