<?php
session_start();

include_once("../functions/assembly.php");

$uid = $_SESSION['id'];
$src = $_POST['src'];

$val = remove_montage($uid, $src);

if ($val == 0) {
  echo "OK";
  unlink("../assembly/" . $src);
} else {
  echo "KO";
}

?>
