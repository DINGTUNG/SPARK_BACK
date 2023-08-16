<?php
    require_once("../../connect_chd102g3.php");
    try {
        $story_no = $_GET['story_no'];
        $is_story_online = $_GET['is_story_online'];
        if ( $is_story_online == 1 ) {
            $status_code = 0;
        } else {
            $status_code = 1;
        }
        $online_count = "SELECT COUNT(is_story_online) FROM story WHERE is_story_online = 1";
        $online_count_result = $pdo->query($online_count);
        $online_count_row = $online_count_result->fetch(PDO::FETCH_ASSOC);
        if ($online_count_row['COUNT(is_story_online)'] >= 18 && $status_code == 1) {
            exit();
        }
        $sql = "UPDATE story SET is_story_online = :status_code  WHERE story_no = :story_no";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':status_code', $status_code);
        $stmt->bindValue(':story_no', $story_no);
        $stmt->execute();
        header("Location:https://tibamef2e.com/chd102/g3/back-end/story");


    } catch(PDOException $e){
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        echo "系統暫時不能正常運行，請稍後再試<br>";
        error_log($e->getMessage());
    }
?>