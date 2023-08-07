<?php
    require_once('../../conn.php');

    $story_title = $_POST['story_title'];
    $story_date = $_POST['story_date'];
    // $story_image = $_POST['story_image'];
    $story_brief = $_POST['story_brief'];
    $story_detail = $_POST['story_detail'];
    $story_detail_second = $_POST['story_detail_second'];
    $story_detail_third = $_POST['story_detail_third'];

    //自動產生 story_id
    $sql_id = "SELECT COUNT(story_id) FROM story";
    $count= $conn->query($sql_id);
    // 將 $count_result 轉換為整數型別
    $row = $count->fetch_assoc();
    $count_result = $row['COUNT(story_id)'];
    
    $story_id_assignment = "ST" . str_pad(($count_result + 1), 3, '0', STR_PAD_LEFT); 
    echo $story_id_assignment;

    //新增資料
    $sql = "INSERT INTO story(`story_id`, `story_title`, `story_brief`, `story_detail`, `story_detail_second`, `story_detail_third`, `story_date`) 
        VALUES ('$story_id_assignment', '$story_title', '$story_brief', '$story_detail', '$story_detail_second', '$story_detail_third', '$story_date')";


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
            "massage" => "新增失敗" . $conn->error
        );
        $response = json_encode($json);
        echo $response;
        header("Location: http://localhost:5173/story");
    }
?>