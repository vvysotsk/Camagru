<?php
session_start();
include_once("functions/assembly.php");
include_once("functions/like.php");

$layimg_page = 5;

$assemblpic = get_assemblpic(0, $layimg_page);
$allloda = false;
$endpicid = 0;
if ($assemblpic != "" && array_key_exists("more", $assemblpic)) {
    $allloda = true;
    $endpicid = $assemblpic[count($assemblpic) - 2]['id'];
}
?>
<!DOCTYPE html>
<HTML>
    <header>
        <title>CAMAGRU</title>
        <link rel="stylesheet" type="text/css" href="style/vbas.css">
        <link rel="stylesheet" type="text/css" href="style/views.css">
        <link rel="stylesheet" type="text/css" href="style/comment.css">
        <meta charset="UTF-8">
    </header>
    <body>
        <?php include('header.php') ?>
        <div id="views">
            <?php
            $gallery = "";
            if ($assemblpic != null && $assemblpic['error'] == null) {
                for ($i = 0; $assemblpic[$i] && $i < $layimg_page; $i++) {
                    $class = "icon";
                    ?> <div class="toto"></div> <?php
                    if ($assemblpic[$i]['usnubm'] === $_SESSION['id']) {
                        $class .= " removable";
                    }
                    $comments = get_comments($assemblpic[$i]['img']);
                    $j = 0;
                    $commentsHTML = "";
                    while ($comments[$j] != null) {
                        $commentsHTML .= "<span class=\"comment\">" . htmlspecialchars($comments[$j]['username']) . ": " . htmlspecialchars($comments[$j]['comment']) . "</span>";
                        $j++;
                    }
                    ?> <div class="toto"></div> <?php
                    $gallery .= "
            <div class=\"img\" data-img=\"" . $assemblpic[$i]['img'] . "\">
              <img class=\"" . $class . "\" src=\"assembly/" . $assemblpic[$i]['img'] . "\"></img>
              <div id=\"buttons-like\">
                <img class=\"button-like\" src=\"img/like.png\" data-image=\"" . $assemblpic[$i]['img'] . "\"></img>
                <span class=\"nb-like\" data-src=\"" . $assemblpic[$i]['img'] . "\">" . getlikenb($assemblpic[$i]['img']) . "</span>
                <img class=\"button-dislike\" src=\"img/dislike.png\" data-image=\"" . $assemblpic[$i]['img'] . "\"></img>
                <span class=\"nb-dislike\" data-src=\"" . $assemblpic[$i]['img'] . "\">" . getdislnb($assemblpic[$i]['img']) . "</span>
              </div>"
                            . $commentsHTML .
                            "</div>";
                }
                echo $gallery;
            }
            ?>
        </div>
        <div id="editphoto">
            <div class="editphoto-content">
                <div class="editphoto-header">
                    <span class="exit">×</span>
                </div>
                <div class="editphoto-body">
                    <img id="img-editphoto">
                </div>
                <div class="editphoto-footer">
                    <textarea <?php if (!$_SESSION['id']) echo "disabled" ?> id="comment" placeholder="Comment..." rows="5" cols="50" maxlength="255"></textarea>
                    <div <?php if (!$_SESSION['id']) echo "disabled=\"true\"" ?> id="send-comment" class="button-send <?php if (!$_SESSION['id']) echo "disabled" ?>">Send</div>
                </div>
            </div>
        </div>
        <?php if ($allloda == true) { ?>
            <div id="load-more" onclick="loadMore(<?php echo($endpicid) ?>, <?php echo($layimg_page) ?>)">... LOAD MORE</div>
        <?php }
        include('footer.php')
        ?>
    </body>
</HTML>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="js/comment.js"></script>
<script type="text/javascript" src="js/like.js"></script>
<script type="text/javascript" src="js/picload.js"></script>