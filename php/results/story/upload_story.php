<?php
    require_once("../../conn.php");
    $story_no = $_GET['story_no'];
    $is_story_online = $_GET['is_story_online'];
    if ( $is_story_online == 1 ) {
        $status_code = 0;
    } else {
        $status_code = 1;
    }

    $online_count = "SELECT COUNT(is_story_online) FROM story WHERE is_story_online = 1";
    $online_count_result = $conn->query($online_count);
    $online_count_row = $online_count_result->fetch_assoc();
    if ($online_count_row['COUNT(is_story_online)'] >= 6) {
        header('Location: http://localhost:5173/story');
        exit();
    }

    $sql = "UPDATE story SET is_story_online = $status_code  WHERE story_no = $story_no";


    if ($conn->query($sql)) {
        header('Location: http://localhost:5173/story');
    } else {
        $json = array(
            "ok" => false,
            "massage" => "上線失敗"
        );
        $response = json_encode($json);
        echo $response;
        header('Location: http://localhost:5173/story');
    }
?>