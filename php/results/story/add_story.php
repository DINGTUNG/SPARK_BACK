<?php
    require_once("../../connect_chd102g3.php");

    $story_title = $_POST['story_title'];
    $story_date = $_POST['story_date'];
    $story_brief = $_POST['story_brief'];
    $story_detail = $_POST['story_detail'];
    $story_detail_second = $_POST['story_detail_second'];
    $story_detail_third = $_POST['story_detail_third'];

    //自動產生 story_id
    $sql_id = "SELECT COUNT(story_id) FROM story";
    $count= $pdo->query($sql_id);
    // 將 $count_result 轉換為整數型別
    $row = $count->fetch(PDO::FETCH_ASSOC);
    $count_result = $row['COUNT(story_id)'];
    $story_id_assignment = "ST" . str_pad(($count_result + 1), 3, '0', STR_PAD_LEFT); 



    //上傳圖片
    if($_FILES['story_image']['error']>0){
        die("檔案上傳失敗");
        }
        $targetDir = 'C:/Users/T14 Gen 3/Desktop/SPARK/public/pictures/images/results/story-gallery/story/';
        $storyNo = $story_id_assignment;
    
        // 得到原始檔案名稱
        $originalFileName = $_FILES['story_image']['name'];
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    
        // 創建新檔案名稱
        $newFileName = "story_" . $storyNo . "." . $fileExtension;
        $targetPath = $targetDir . $newFileName;
        move_uploaded_file($_FILES['story_image']['tmp_name'], $targetPath);


    //新增資料
    $sql = "INSERT INTO story(`story_id`, `story_title`, `story_image`, `story_brief`, `story_detail`, `story_detail_second`, `story_detail_third`, `story_date`) 
        VALUES ('$story_id_assignment', '$story_title', '$newFileName', '$story_brief', '$story_detail', '$story_detail_second', '$story_detail_third', '$story_date')";


    $result = $pdo->query($sql);

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