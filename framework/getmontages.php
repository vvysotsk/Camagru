<?php
session_start();

include_once("../functions/assembly.php");
include_once("../functions/like.php");

$id = $_POST['id'];
$nb = $_POST['nb'];

if ($id == null || $id == "" || $nb == null || $nb == "") {
  echo "KO";
  return;
}

$assemblpic = [];

$assemblpic = get_montages2($id, $nb);
for ($i = 0; $i < count($assemblpic); $i++) {
  $assemblpic[$i]['dislikes'] = get_nb_dislikes2($assemblpic[$i]['img']);
  $assemblpic[$i]['likes'] = get_nb_likes2($assemblpic[$i]['img']);
  $comments = get_comments2($assemblpic[$i]['img']);
  if ($comments[0] != null) {
    $assemblpic[$i]['comments'] = $comments;
  } else {
    $assemblpic[$i]['comments'] = null;
  }
}
if (count($assemblpic) <= 0) {
  echo "KO";
  return;
}
print_r(json_encode($assemblpic));

?>
