<?php
    require_once("../../connect_chd102g3.php");
    $story_no = $_POST['story_no'];
    $sql = "UPDATE story SET del_flg=1, updater='希', updater_time=Now() WHERE story_no = ".$story_no;

    if ($pdo->query($sql)) {
        $json = array(
            "status" => "ok",
        );
        echo json_encode($json);
    } else {
        $json = array(
            "status" => "error",
            "msg" => "刪除失敗",
        );
        echo json_encode($json);
    }
?>