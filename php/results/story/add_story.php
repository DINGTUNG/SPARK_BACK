<?php
    require_once('../../conn.php');

    $story_title = $_POST['story_title'];
    $story_date = $_POST['story_date'];
    $story_image = $_POST['story_image'];
    $story_brief = $_POST['story_brief'];
    $story_detail_second = $_POST['story_detail_second'];
    $story_detail_third = $_POST['story_detail_third'];

    // if ( empty($story_title) || empty($story_date) || empty($story_brief)) {
    //     $json = array(
    //         "ok" => false,
    //         "massage" => "資料不得為空"
    //     );
    //     $response = json_encode($json);
    //     echo $response;
    //     die();
    // }

    $sql = "INSERT INTO `story`(`story_title`, `story_brief`, `story_detail_second`, `story_detail_third`, `story_date`) VALUES ('$story_title','$story_brief','$story_detail_second','$story_detail_third','$story_date')";

    $result = $conn->query($sql);
    if ($result) {
        $json = array(
            "ok" => true,
            "massage" => "新增成功"
        );
        $response = json_encode($json);
        echo $response;
        header("Location: http://localhost:5173/story");
    } else {
        $json = array(
            "ok" => false,
            "massage" => "新增失敗"
        );
        $response = json_encode($json);
        echo $response;
        header("Location: http://localhost:5173/story");
    }
?>