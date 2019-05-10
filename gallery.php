<?php
session_start();
include_once("functions/assembly.php");
$assemblpic = getallassembl();
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/gallery.css">
    <meta charset="UTF-8">
    <title>CAMAGRU - gallery</title>
  </header>
  <body>
    <?php include('header.php') ?>
      <div class="body">
        <?php if(isset($_SESSION['id'])) { ?>
        <div class="main">
    		  <div class="select">
      			<img class="thumbnail" src="img/frame.png"></img>
      			<input id="frame.png" type="radio" name="img" value="./img/frame.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/smoke.png"></img>
      			<input id="smoke.png" type="radio" name="img" value="./img/smoke.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/kitty.png"></img>
      			<input id="kitty.png" type="radio" name="img" value="./img/kitty.png" onclick="onCheckBoxChecked(this)">
    		  </div>
          <video width="100%" autoplay="true" id="webcam"></video>
          <div id="camera-not-available">CAMERA NOT AVAILABLE</div>
          <img id="hat" style="display:none;" src="img/kitty.png"></img>
          <img id="cigarette" style="display:none;" src="img/smoke.png"></img>
          <img id="cadre" style="display:none;" src="img/frame.png"></img>
    		  <div class="capture" id="pickImage">
            <img class="camera" src="img/camera.png"></img>
          </div>
          <canvas id="canvas" style="display:none;" width="640" height="480"></canvas>
          <div class="captureFile" id="pickFile">
            <img class="camera" src="img/camera.png"></img>
          </div>
          <input type="file" id="take-picture" style="display:none;" accept="image/*">
        </div>
        <div class="side">
			<div class="title">Assembly</div>
      <div id="miniatures">
        <?php
          $gallery = "";
          if ($assemblpic != null) {
            for ($i = 0; $assemblpic[$i] ; $i++) {
              $class = "icon";
              if ($assemblpic[$i]['userid'] === $_SESSION['id']) {
                $class .= " removable";
              }
              $gallery .= "<img class=\"" . $class . "\" src=\"./assembly/" . $assemblpic[$i]['img'] . "\" data-userid=\"" . $assemblpic[$i]['userid'] . "\"></img>";
            }
            echo $gallery;
          }
        ?>
      </div>
	</div>
        <?php } 
        else {
            echo "You need to connect to use the gallery";
        } ?>
      </div>
    <?php include('footer.php') ?>
  </body>
  <?php if(isset($_SESSION['id'])) { ?>
  <script type="text/javascript" src="js/util.js"></script>
  <script type="text/javascript" src="js/webcam.js"></script>
  <script type="text/javascript" src="js/drop.js"></script>
  <script type="text/javascript" src="js/import.js"></script>
  <?php } ?>
</HTML>
