<?php
session_start();

include_once '../functions/assembly.php';

$assemblsrc = "../assembly/";

// retreive values
$img = $_POST['img'];
$filter = $_POST['f'];
$id = $_SESSION['id'];

$filter = str_replace('data:image/png;base64,', '', $filter);
$filter = str_replace(' ', '+', $filter);
$data = base64_decode($filter);

$uiid = uniqid();

if (!file_exists($assemblsrc)) {
  mkdir($assemblsrc);
}

file_put_contents($assemblsrc . $uiid . '.png', $data);

if (strcmp($img, "../img/cigarette.png") == 0  || strcmp($img, "../img/hat.png") == 0) {
  $copy = imagecreatetruecolor(240, 180);
} else {
  $copy = imagecreatetruecolor(640, 480);
}
imagealphablending($copy, false);
imagesavealpha($copy, true );

$source = imagecreatefrompng($img);

if (strcmp($img, "../img/cigarette.png") == 0  || strcmp($img, "../img/hat.png") == 0) {
  imagecopyresized($copy, $source, 0, 0, 0, 0, 240, 180, 1024, 768);
} else {
  imagecopyresized($copy, $source, 0, 0, 0, 0, 640, 480, 1024, 768);
}

$destination = imagecreatefrompng($assemblsrc . $uiid . ".png");

// The imagesx and imagesy functions return the width and height of an image
$width_source = imagesx($copy);
$height_source = imagesy($copy);
$width_destination = imagesx($destination);
$height_destination = imagesy($destination);

if (strcmp($img, "../img/cigarette.png") == 0) {
  $destination_x = 100;
  $destination_y = 200;
} else if (strcmp($img, "../img/hat.png") == 0) {
  $destination_x = 180;
  $destination_y = 0;
} else {
  $destination_x = 0;
  $destination_y = 0;
}

// We put the logo (source) in the destination image (the photo)
imagecopymerge_alpha($destination, $copy, $destination_x, $destination_y, 0, 0, $width_source, $height_source, 100);

// We display the destination image that has been merged with the logo
$success = imagepng($destination, $assemblsrc . $uiid . ".png");

if ($success) {
  if (($val = add_montage($id, $uiid . '.png')) === 0){
      echo ($uiid . '.png');
  } else {
    echo $val;
  }
}

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
    // creating a cut resource
    $cut = imagecreatetruecolor($src_w, $src_h);

    // copying relevant section from background to the cut resource
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

    // copying relevant section from watermark to the cut resource
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

    // insert cut resource to destination image
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}
?>
