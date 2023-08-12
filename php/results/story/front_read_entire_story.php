<?php
    require_once("../../connect_chd102g3.php");

    try {
        $story_no = $_GET['story_no'];
        $sql = "SELECT * FROM story WHERE is_story_online=1 AND story_no= :story_no ORDER BY story_no DESC";
        $getStoryStmt = $pdo->prepare($sql);
        $getStoryStmt->bindValue(':story_no', $story_no);
        $getStoryStmt->execute();  
        $res = json_encode($getStoryStmt->fetchAll(PDO::FETCH_ASSOC));
        echo $res;
    } catch (PDOException $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        echo "系統暫時不能正常運行，請稍後再試<br>";
    }

