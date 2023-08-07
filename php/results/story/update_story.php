<?php
    require_once('../../conn.php');
    header("Access-Control-Allow-Origin: *");

    $story_no = $_GET['story_no'];

    $story_title = $_POST['story_title'];
    $story_date = $_POST['story_date'];
    $story_image = $_POST['story_image'];
    $story_brief = $_POST['story_brief'];
    $story_detail = $_POST['story_detail'];
    $story_detail_second = $_POST['story_detail_second'];
    $story_detail_third = $_POST['story_detail_third'];

    $sql = "UPDATE story SET story_title = '$story_title', story_date = '$story_date', story_image = '$story_image', story_brief = '$story_brief', story_detail = '$story_detail', story_detail_second = '$story_detail_second', story_detail_third = '$story_detail_third' WHERE story_no = $story_no";


    $result = $conn->query($sql);
    
    if ($result) {
        $json = array(
            "ok" => true,
            "massage" => "更新成功"
        );
        $response = json_encode($json);
        echo $response;
        header("Location: http://localhost:5173/story");
    } else {
        $json = array(
            "ok" => false,
            "massage" => "更新失敗"
        );
        $response = json_encode($json);
        echo $response;
        header("Location: http://localhost:5173/story");
    }
?>