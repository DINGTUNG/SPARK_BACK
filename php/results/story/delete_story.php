<?php
    require_once('../../conn.php');
    $story_no = $_GET['story_no'];
    $sql = "UPDATE story SET del_flg=1, updater='希', updater_time=Now() WHERE story_no = ". $story_no;

    if ($conn->query($sql)) {
        header('Location: http://localhost:5173/story');
    } else {
        echo('刪除失敗'.$conn->error);
    }
?>