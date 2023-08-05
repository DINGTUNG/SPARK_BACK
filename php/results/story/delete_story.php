<?php
    require_once('../../conn.php');
    $story_no = $_GET['story_no'];
    $sql = "DELETE FROM story WHERE story_no = ". $story_no;
    if ($conn->query($sql)) {
        header('Location: http://localhost:5173/story');
    } else {
        echo('刪除失敗'.$conn->error);
    }
?>