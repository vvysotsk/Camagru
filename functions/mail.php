<?php

function sendverificationemail($toAddr, $toUsername, $chusid, $ip) {
  $subject = "[CAMAGRU] - Email verification";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $headers .= 'From: <vvysotsk@student.42.fr>' . "\r\n";

  $message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($toUsername) . ' </br>
      To finalyze your subscribtion please click the link below </br>
      <a href="http://' . $ip . '/verify.php?token=' . $chusid . '">Verify my email</a>
    </body>
  </html>
  ';

  mail($toAddr, $subject, $message, $headers);
}

function sendrestoremail($toAddr, $toUsername, $userpass) {
  $subject = "[CAMAGRU] - Reset your password";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $headers .= 'From: <yfuks@student.42.fr>' . "\r\n";

  $message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($toUsername) . ' </br>
      There is your new password : ' . $userpass . ' </br>
    </body>
  </html>
  ';

  mail($toAddr, $subject, $message, $headers);
}

function usermailcominfo($toAddr, $toUsername, $comtxt, $fromUsername, $img, $ip) {
  $subject = "[CAMAGRU] - New comment";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $headers .= 'From: <yfuks@student.42.fr>' . "\r\n";

  $message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($toUsername) . ' </br>
      A user just commented one of your montage</br>
      <img src="http://' . $ip . '/assembly/' . $img . '" style="width: 388px;height: 291px;display: block;margin: 20px;"></img>
      <span>' . htmlspecialchars($fromUsername) . ': ' . htmlspecialchars($comtxt) . '</span>
    </body>
  </html>
  ';

  mail($toAddr, $subject, $message, $headers);
}
?>
