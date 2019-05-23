<?php

function sendverificationemail($useremail, $usemn_mail, $chusid, $ip) {
    $subject = "CAMAGRU - Email verification";

    $message = '
      Hello ' . htmlspecialchars($usemn_mail) . '
      To finalyze your subscribtion please click this link:
      http://' . $ip . '/verify.php?uniqident=' . $chusid;

    mail($useremail, $subject, $message);
}

function sendrestoremail($useremail, $usemn_mail, $userpass) {
    $subject = "CAMAGRU - Reset your password";

    $message = '
      Hello ' . htmlspecialchars($usemn_mail) . '
      There is your new password : ' . $userpass;

    mail($useremail, $subject, $message);
}

function usermailcominfo($useremail, $usemn_mail, $comtxt, $usfcom, $img, $ip) {
    $subject = "CAMAGRU - New comment";

    $message = '
      Hello ' . htmlspecialchars($usemn_mail) . '
      A user just commented one of your picture:
      user:  ' . htmlspecialchars($usfcom) . '
      comment:  ' . htmlspecialchars($comtxt);
    mail($useremail, $subject, $message);
}

?>
