<?php

session_start();
include_once("../functions/assembly.php");
include_once("../functions/mail.php");

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$img = $_POST['img'];
$comtxt = $_POST['comment'];

if ($uid == null || $comtxt == null || $comtxt == "" ||
        $img == null || $img == "" || strlen($comtxt) > 255) {
    return;
}

$val = comment($uid, $img, $comtxt);
$info_user = aseembluserinfo($img);
$url = $_SERVER['HTTP_HOST'] . str_replace("/framework/comment.php", "", $_SERVER['REQUEST_URI']);

if ($val === 0) {
    if ($info_user['username']) {
        usermailcominfo($info_user['mail'], $info_user['username'], $comtxt, $username, $img, $url);
    }
    echo htmlspecialchars($username);
}
?>
