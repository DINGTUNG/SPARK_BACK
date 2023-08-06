<?php
    require_once("../../conn.php");
    $story_no = $_GET['story_no'];
    $is_story_online = $_GET['is_story_online'];
    if ( $is_story_online == 1 ) {
        $status_code = 0;
    } else {
        $status_code = 1;
    }
    echo $story_no ." ". $is_story_online. "<br>";
    echo $status_code. "<br>";
    $sql = "UPDATE story SET is_story_online = $status_code  WHERE story_no = $story_no";
    if ($conn->query($sql)) {
        header('Location: http://localhost:5173/story');
    } else {
        echo('刪除失敗'.$conn->error);
    }
?>