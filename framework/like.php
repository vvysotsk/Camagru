<?php

session_start();
include_once("../functions/like.php");

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$img = $_POST['img'];
$ldval = $_POST['type'];

if ($uid == null || $img == null || $img == "" || $ldval == null ||
        $ldval == "" || ($ldval != "L" && $ldval != "D")) {
    return;
}

$keyr = getlike($uid, $img);

if ($keyr != null && array_key_exists('type', $keyr)) {
    if ($keyr['type'] == $ldval) {
        echo "KO";
    } else {
        $val = updatelike($uid, $img, $ldval);
        if ($val == 0) {
            echo "LIKE CHANGE";
        } else {
            echo $val;
        }
    }
} else {
    $val = addlike($uid, $img, $ldval);

    if ($val == 0) {
        echo "ADD LIKE";
    } else {
        echo $val;
    }
}
?>
