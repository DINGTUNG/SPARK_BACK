<?php
    require_once('../../conn.php');
    header("Access-Control-Allow-Origin: *");

    $story_no = $_GET['story_no'];
    $story_title = $_POST['story_title'];
    $story_date = $_POST['story_date'];
    $story_brief = $_POST['story_brief'];
    $story_detail = $_POST['story_detail'];
    $story_detail_second = $_POST['story_detail_second'];
    $story_detail_third = $_POST['story_detail_third'];

    //得到 story_id
    $sql_get_story_id = "SELECT story_id FROM story WHERE story_no = $story_no";
    $result_get_story_id = $conn->query($sql_get_story_id);
    if($row = $result_get_story_id->fetch_assoc()){
        $story_id = $row['story_id'];
    }
   

    if($_FILES['story_image']['error']>0){
        die("檔案上傳失敗");
        } else {
            echo "檔案上傳成功";
            $targetDir = 'C:/Users/T14 Gen 3/Desktop/SPARK/public/pictures/images/results/story-gallery/story/';
            $storyNo = $story_id;
        
            // Get the original file extension
            $originalFileName = $_FILES['story_image']['name'];
            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        
            // Construct the new file name
            $newFileName = "story_" . $storyNo . "." . $fileExtension;
            $targetPath = $targetDir . $newFileName;
            move_uploaded_file($_FILES['story_image']['tmp_name'], $targetPath);
        }


    $sql = "UPDATE story SET story_title = '$story_title', story_date = '$story_date', story_image = '$newFileName', story_brief = '$story_brief', story_detail = '$story_detail', story_detail_second = '$story_detail_second', story_detail_third = '$story_detail_third' WHERE story_no = $story_no";


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