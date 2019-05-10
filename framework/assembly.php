<?php
session_start();
include_once '../functions/assembly.php';

$assemblsrc = "../assembly/";

$img = $_POST['img'];
$checkim = $_POST['f'];
$id = $_SESSION['id'];

$checkim = str_replace('data:image/png;base64,', '', $checkim);
$checkim = str_replace(' ', '+', $checkim);
$data = base64_decode($checkim);

$uniid = uniqid();

if (!file_exists($assemblsrc)) {
  mkdir($assemblsrc);
}

file_put_contents($assemblsrc.$uniid.'.png', $data);

if (strcmp($img, "../img/smoke.png") == 0  || strcmp($img, "../img/kitty.png") == 0) {
  $imgco = imagecreatetruecolor(240, 180);
} else {
  $imgco = imagecreatetruecolor(640, 480);
}
imagealphablending($imgco, false);
imagesavealpha($imgco, true );

$source = imagecreatefrompng($img);

if (strcmp($img, "../img/smoke.png") == 0  || strcmp($img, "../img/kitty.png") == 0) {
  imagecopyresized($imgco, $source, 0, 0, 0, 0, 240, 180, 1024, 768);
} else {
  imagecopyresized($imgco, $source, 0, 0, 0, 0, 640, 480, 1024, 768);
}

$destination = imagecreatefrompng($assemblsrc . $uniid . ".png");
$widthsrc = imagesx($imgco);
$heightsrc = imagesy($imgco);
$widthdest = imagesx($destination);
$heightdest = imagesy($destination);

if (strcmp($img, "../img/smoke.png") == 0) {
  $widthimage = 100;
  $heightimage = 200;
} else if (strcmp($img, "../img/kitty.png") == 0) {
  $widthimage = 180;
  $heightimage = 0;
} else {
  $widthimage = 0;
  $heightimage = 0;
}
// Put the logo (source) in the destination image (the photo)
image_merge($destination, $imgco, $widthimage, $heightimage, 0, 0, $widthsrc, $heightsrc, 100);
// Display the destination image that has been merged with the logo
$i_check = imagepng($destination, $assemblsrc . $uniid . ".png");

if ($i_check) {
  if (($val = addlassembl($id, $uniid . '.png')) === 0){
      echo ($uniid . '.png');
  } else {
    echo $val;
  }
}

function image_merge($imgdst, $imgsrc, $widthdst, $heightdst, $widthsrc, $heightsrc, $width, $height, $img){
    // creating a cut resource
    $cut = imagecreatetruecolor($width, $height);
    // copying relevant section from background to the cut resource
    imagecopy($cut, $imgdst, 0, 0, $widthdst, $heightdst, $width, $height);
    // copying relevant section from watermark to the cut resource
    imagecopy($cut, $imgsrc, 0, 0, $widthsrc, $heightsrc, $width, $height);
    // insert cut resource to destination image
    imagecopymerge($imgdst, $cut, $widthdst, $heightdst, 0, 0, $width, $height, $img);
}
?>
