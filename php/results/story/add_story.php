<?php
    require_once("../../connect_chd102g3.php");

    try{
        $story_title = $_POST['story_title'];
        $story_date = $_POST['story_date'];
        $story_brief = $_POST['story_brief'];
        $story_detail = $_POST['story_detail'];
        $story_detail_second = $_POST['story_detail_second'];
        $story_detail_third = $_POST['story_detail_third'];
        $story_image = $_FILES['story_image'];

        // 自動產生 story_id
        $sql_id = "SELECT COUNT(story_id) FROM story";
        $count= $pdo->query($sql_id);
        // 將 $count_result 轉換為整數型別
        $row = $count->fetch(PDO::FETCH_ASSOC);
        $count_result = $row['COUNT(story_id)'];
        $story_id_assignment = "ST" . str_pad(($count_result + 1), 3, '0', STR_PAD_LEFT); 

        //上傳圖片
        if(!$story_image){
            $json = array(
                "ok" => false,
                "massage" => "請上傳圖片"
            );
            $response = json_encode($json);
            echo $response;
        } else {
            $targetDir = '../../../images/story/';
            $storyId = $story_id_assignment;

            // 得到原始檔案名稱
            $originalFileName = $_FILES['story_image']['name'];
            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

            // 創建新檔案名稱
            $newFileName = "story_" . $storyId . "." . $fileExtension;
            $targetPath = $targetDir . $newFileName;

            //存入檔案
            if (file_exists($targetDir) === false) {
                mkdir($targetDir);
            }
            $from = $_FILES['story_image']['tmp_name'];
            $to = $targetPath;
            copy($from, $to);
        }

    
    
        //新增資料
        $sql = "INSERT INTO story(`story_id`, `story_title`, `story_image`, `story_brief`, `story_detail`, `story_detail_second`, `story_detail_third`, `story_date`) 
            VALUES (:story_id_assignment, :story_title, :story_image, :story_brief, :story_detail, :story_detail_second, :story_detail_third, :story_date)";

        $addStory = $pdo->prepare($sql);
        $addStory->bindValue(":story_id_assignment", $story_id_assignment);
        $addStory->bindValue(":story_title", $story_title);
        $addStory->bindValue(":story_image", $newFileName);
        $addStory->bindValue(":story_brief", $story_brief);
        $addStory->bindValue(":story_detail", $story_detail);
        $addStory->bindValue(":story_detail_second", $story_detail_second);
        $addStory->bindValue(":story_detail_third", $story_detail_third);
        $addStory->bindValue(":story_date", $story_date);
        $result = $addStory->execute();

        header("Location:https://tibamef2e.com/chd102/g3/back-end/story");

    
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>