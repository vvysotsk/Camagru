<?php

function sendverificationemail($useremail, $usemn_mail, $chusid, $ip) {
    $subject = "CAMAGRU - Email verification";

    $message = '
  <html>
    <body> 
      Hello ' . htmlspecialchars($usemn_mail) . '</br>
      To finalyze your subscribtion please click the link below </br>
      <a href="http://' . $ip . '/verify.php?uniqident=' . $chusid . '">Verify my email</a>
    </body>
  </html>
  ';

    mail($useremail, $subject, $message);
}

function sendrestoremail($useremail, $usemn_mail, $userpass) {
    $subject = "CAMAGRU - Reset your password";

    $message = '
  <html>
    <body>
      Hello ' . htmlspecialchars($usemn_mail) . ' </br>
      There is your new password : ' . $userpass . ' </br>
    </body>
  </html>
  ';

    mail($useremail, $subject, $message);
}

function usermailcominfo($useremail, $usemn_mail, $comtxt, $usfcom, $img, $ip) {
    $subject = "CAMAGRU - New comment";

    $message = '
  <html>
    <body>
      Hello ' . htmlspecialchars($usemn_mail) . '</br>
      A user just commented one of your picture</br>
      <img src="http://' . $ip . '/assembly/' . $img . '"style="width: 388px;height: 291px;display: block;margin: 20px;"></img>
      <span>' . htmlspecialchars($usfcom) . ': ' . htmlspecialchars($comtxt) . '</span>
    </body>
  </html>
  ';
    mail($useremail, $subject, $message);
}

?>
