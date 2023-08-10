<?php
    require_once("../../connect_chd102g3.php");

    $report_class = $_POST['report_class'];
    $report_year = $_POST['report_year'];
    $report_title = $_POST['report_title'];
    //自動產生 story_id
    $sql_id = "SELECT COUNT(report_id) FROM reports";
    $count= $pdo->query($sql_id);
    // 將 $count_result 轉換為整數型別
    $row = $count->fetch(PDO::FETCH_ASSOC);
    $updateSql = "update message_board set report_id = concat('SM',LPAD(LAST_INSERT_ID(), 3, 0)) where message_no = LAST_INSERT_ID()";
    $updateStmt = $pdo->prepare($updateSql);
    $updateResult = $updateStmt->execute();
    $pdo->commit();
  

    //上傳圖片
    if($_FILES['report_file']['error']>0){
        die("檔案上傳失敗");
        }
        $targetDir = 'C:/Users/T14 Gen 3/Desktop/SPARK/public/PDF/';
        $reportNo = $report_id_assignment;
    
        // 得到原始檔案名稱
        $originalFileName = $_FILES['report_file']['name'];
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    
        // 創建新檔案名稱
        $newFileName = "R_" . $reportNo . "." . $fileExtension;
        $targetPath = $targetDir . $newFileName;
        move_uploaded_file($_FILES['report_file']['tmp_name'], $targetPath);


    //新增資料
    $sql = "INSERT INTO report(`report_id`, `report_class`, `report_title`, `report_year`, `report_file_path`) 
        VALUES ('$report_id_assignment', '$report_class', '$report_title', '$report_year', '$newFileName')";


    $result = $pdo->query($sql);

    if ($result) {
        $json = array(
            "ok" => true,
            "massage" => "新增成功"
        );
        $response = json_encode($json);
        echo $response;
        // header("Location: http://localhost:5173/report");
    } else {
        $json = array(
            "ok" => false,
            "massage" => "新增失敗" . $conn->error
        );
        $response = json_encode($json);
        echo $response;
        // header("Location: http://localhost:5173/report");
    }
?>