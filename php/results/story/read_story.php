<?php
    require_once("../../connect_chd102g3.php");

    try{
        $sql = "SELECT * FROM story WHERE del_flg=0 ORDER BY story_no DESC";
        $result = $pdo->query($sql);
        $res = json_encode($result->fetchAll(PDO::FETCH_ASSOC));
        echo $res;
    }
    catch(PDOException $e){
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        echo "系統暫時不能正常運行，請稍後再試<br>";
    }
?>