<?php
    require_once("../../connect_chd102g3.php");
    header("Access-Control-Allow-Origin: *");

    $story_no = $_GET['story_no'];
    $story_title = $_POST['story_title'];
    $story_date = $_POST['story_date'];
    $story_brief = $_POST['story_brief'];
    $story_detail = $_POST['story_detail'];
    $story_detail_second = $_POST['story_detail_second'];
    $story_detail_third = $_POST['story_detail_third'];

    //得到原本的圖片名稱
    $sql_get_story_image = "SELECT story_image FROM story WHERE story_no = $story_no";
    $result_get_story_image = $pdo->query($sql_get_story_image);
    if($row = $result_get_story_image->fetch(PDO::FETCH_ASSOC)){
        $story_image = $row['story_image'];
    }

    //得到 story_id
    $sql_get_story_id = "SELECT story_id FROM story WHERE story_no = $story_no";
    $result_get_story_id = $pdo->query($sql_get_story_id);
    if($row = $result_get_story_id->fetch(PDO::FETCH_ASSOC)){
        $story_id = $row['story_id'];
    }
   
    //上傳圖片
    if ($_FILES['story_image']['name']) {
        $targetDir = '../../../images/story/';
        $storyNo = $story_id;
    
        // 得到上傳檔案的副檔名。
        $originalFileName = $_FILES['story_image']['name'];
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    
        // 創建新名稱。
        $newFileName = "story_" . $storyNo . "." . $fileExtension;
        $targetPath = $targetDir . $newFileName;
    
        // 檢查目標目錄是否存在，不存在則創建它。
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        move_uploaded_file($_FILES['story_image']['tmp_name'], $targetPath);
    } else {
        $newFileName = $story_image;
    }
    


    $sql = "UPDATE story SET story_title = '$story_title', story_date = '$story_date', story_image = '$newFileName', story_brief = '$story_brief', story_detail = '$story_detail', story_detail_second = '$story_detail_second', story_detail_third = '$story_detail_third' WHERE story_no = $story_no";


    $result = $pdo->query($sql);
    
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