<?php

session_start();
include '../functions/login.php';

$mail = $_POST['email'];
$userpass = $_POST['password'];

if (($val = log_user($mail, $userpass)) == -1) {
    $_SESSION['error'] = "user not found";
} else if (isset($val['err'])) {
    $_SESSION['error'] = $val['err'];
} else {
    $_SESSION['id'] = $val['id'];
    $_SESSION['username'] = $val['username'];
}

header('Location: http://' . $_SERVER['HTTP_HOST']);
?>
