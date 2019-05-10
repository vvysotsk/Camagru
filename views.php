<?php
session_start();
include_once("functions/assembly.php");
include_once("functions/like.php");

$imagePerPages = 5;

$assemblpic = get_assemblpic(0, $imagePerPages);
$more = false;
$lastapicId = 0;
if ($assemblpic != "" && array_key_exists("more", $assemblpic)) {
  $more = true;
  $lastapicId = $assemblpic[count($assemblpic) - 2]['id'];
}
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/views.css">
    <link rel="stylesheet" type="text/css" href="style/modal.css">
    <meta charset="UTF-8">
    <title>CAMAGRU</title>
  </header>
  <body>
    <?php include('header.php') ?>
    <div id="views">
      <?php
        $gallery = "";
        if ($assemblpic != null && $assemblpic['error'] == null) {
          for ($i = 0; $assemblpic[$i] && $i < $imagePerPages; $i++) {
            $class = "icon";
            if ($assemblpic[$i]['userid'] === $_SESSION['id']) {
              $class .= " removable";
            }
            $comments = get_comments($assemblpic[$i]['img']);
            $j = 0;
            $commentsHTML = "";
            while ($comments[$j] != null) {
              $commentsHTML .= "<span class=\"comment\">" . htmlspecialchars($comments[$j]['username']) .": " . htmlspecialchars($comments[$j]['comment']) . "</span>";
              $j++;
            }
            $gallery .= "
            <div class=\"img\" data-img=\"" . $assemblpic[$i]['img'] . "\">
              <img class=\"" . $class . "\" src=\"assembly/" . $assemblpic[$i]['img'] . "\"></img>
              <div id=\"buttons-like\">
                <img class=\"button-like\" src=\"img/like.png\" data-image=\"". $assemblpic[$i]['img'] ."\"></img>
                <span class=\"nb-like\" data-src=\"". $assemblpic[$i]['img'] ."\">" . getlikenb($assemblpic[$i]['img']) . "</span>
                <img class=\"button-dislike\" src=\"img/dislike.png\" data-image=\"". $assemblpic[$i]['img'] ."\"></img>
                <span class=\"nb-dislike\" data-src=\"". $assemblpic[$i]['img'] ."\">" . getdislnb($assemblpic[$i]['img']) . "</span>
              </div>"
              . $commentsHTML .
            "</div>";
          }
          echo $gallery;
        }
       ?>
     </div>
     <div id="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">×</span>
        </div>
        <div class="modal-body">
          <img id="img-modal"></img>
        </div>
        <div class="modal-footer">
          <textarea <?php if (!$_SESSION['id']) echo "disabled" ?> id="comment" placeholder="Comment..." rows="5" cols="50" maxlength="255"></textarea>
          <div <?php if (!$_SESSION['id']) echo "disabled=\"true\"" ?> id="send-comment" class="button-send <?php if (!$_SESSION['id']) echo "disabled" ?>">Send</div>
        </div>
      </div>
    </div>
    <?php if ($more == true) { ?>
    <div id="load-more" onclick="loadMore(<?php echo($lastapicId) ?>, <?php echo($imagePerPages) ?>)">... LOAD MORE</div>
    <?php } ?>
    <?php include('footer.php') ?>
  </body>
  <script type="text/javascript" src="js/util.js"></script>
  <script type="text/javascript" src="js/modal.js"></script>
  <script type="text/javascript" src="js/like.js"></script>
  <script type="text/javascript" src="js/loadMore.js"></script>
</HTML>
