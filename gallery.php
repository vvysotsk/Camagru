<?php
session_start();
include_once("functions/assembly.php");
$assemblpic = getallassembl();
?>
<!DOCTYPE html>
<HTML>
    <header>
        <meta charset="UTF-8">
        <title>CAMAGRU - gallery</title>
        <link rel="stylesheet" href="style/gallery.css">
        <link rel="stylesheet" href="style/gal_screen.css">
    </header>
    <body>
        <?php include('header.php') ?>
        <div class="body">
            <?php if (isset($_SESSION['id'])) { ?>
                <div class="main">
                    <div class="choosen">
                        <img src="img/frame.png" class="editpictures">
                        <input type="radio" id="frame.png" name="img" onclick="camcheck(this)" value="./img/frame.png">
                        <img src="img/smoke.png" class="editpictures">
                        <input type="radio" id="smoke.png" name="img" onclick="camcheck(this)" value="./img/smoke.png">
                        <img src="img/kitty.png" class="editpictures">
                        <input type="radio" id="kitty.png" name="img" onclick="camcheck(this)" value="./img/kitty.png">
                    </div>
                    <video id="webcam" autoplay="true" width="100%"></video>
                    <div id="webcam_is_off">CAMERA NOT AVAILABLE</div>-
                    <img src="img/kitty.png" id="kitty" class="img_display">
                    <div class="empty"></div>
                    <img src="img/smoke.png" id="smoke" class="img_display">
                    <div class="empty"></div>
                    <img src="img/frame.png" id="cam" class="img_display" >
                    <div class="empty"></div>
                    <div class="selected" id="selectimg">
                        <img src="img/camera.png" class="makephoto">
                        <div class="empty"></div>
                    </div>
                    <canvas style="display:none;" width="640" height="480" id="canvas"></canvas>
                    <div class="chosefile" id="pickFile">
                        <img src="img/camera.png" class="makephoto">
                        <div class="empty"></div>
                    </div>
                    <input style="display:none;" id="importpic" accept="image/*" type="file">
                </div>
                <div class="side">
                    <div class="log">Assembly</div>
                    <div id="miniatures">
                        <?php
                        $gallery = "";
                        if ($assemblpic != null) {
                            for ($i = 0; $assemblpic[$i]; $i++) {
                                $class = "icon";
                                if ($assemblpic[$i]['usnubm'] === $_SESSION['id']) {
                                    $class .= " removable";
                                }
                                $gallery .= "<img class=\"" . $class . "\" src=\"./assembly/" . $assemblpic[$i]['img'] . "\" data-usnubm=\"" . $assemblpic[$i]['usnubm'] . "\"></img>";
                            }
                            echo $gallery;
                        }
                        ?>
                    </div>
                </div>
                <?php
            } else {
                echo "You need to connect to use the gallery";
            }
            ?>
        </div>
        <?php include('footer.php') ?>
    </body>
    <?php if (isset($_SESSION['id'])) { ?>
        <script type="text/javascript" src="js/util.js"></script>
        <script type="text/javascript" src="js/camera.js"></script>
        <script type="text/javascript" src="js/remove.js"></script>
        <script type="text/javascript" src="js/import.js"></script>
    <?php } ?>
</HTML>
<script type="text/javascript">
    var video_stream = document.getElementById("webcam");
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia){
        navigator.mediaDevices.getUserMedia({ video: true }).then(
            function(stream){
                video_stream.srcObject = stream;
                video_stream.play();
            }
        );
    }
</script>
