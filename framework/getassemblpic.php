<?php

session_start();
include_once("../functions/assembly.php");
include_once("../functions/like.php");

$id = $_POST['id'];
$counter = $_POST['nb'];

if ($id == null || $id == "" || $counter == null || $counter == "") {
    echo "KO";
    return;
}

$assemblpic = [];
$assemblpic = insasmblpic($id, $counter);
for ($i = 0; $i < count($assemblpic); $i++) {
    $assemblpic[$i]['dislikes'] = dislcount($assemblpic[$i]['img']);
    $assemblpic[$i]['likes'] = likecount($assemblpic[$i]['img']);
    $comments = inscomment($assemblpic[$i]['img']);
    if (isset($comments[0])) {
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
