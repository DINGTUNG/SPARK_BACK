<?php
require_once("../../connect_chd102g3.php");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin: http://localhost:5174");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

try {
    $member_account = $_POST['member_account'];
    $member_password = $_POST['member_password'];

    if (empty($member_account) || empty($member_password)) {
        $error = array(
            'status' => 'error',
            'msg' => '請輸入帳號密碼'
        );
        $res = json_encode($error);
        echo $res;
    } else {
        //自動產生 story_id
        $sql_id = "SELECT COUNT(member_id) FROM  member_info";
        $count= $pdo->query($sql_id);
        // 將 $count_result 轉換為整數型別
        $row = $count->fetch(PDO::FETCH_ASSOC);
        $count_result = $row['COUNT(member_id)'];
        $member_id_assignment = "A" . str_pad(($count_result + 1), 3, '0', STR_PAD_LEFT); 

        //會員註冊 第一步
        $sql_register = "INSERT INTO member_info(`member_id`, `member_account`, `member_password`) 
            VALUES (:member_id_assignment, :member_account, :member_password)";
        $registerStmt = $pdo->prepare($sql_register);
        $registerStmt->bindValue(":member_id_assignment", $member_id_assignment);
        $registerStmt->bindValue(":member_account", $member_account);
        $registerStmt->bindValue(":member_password", $member_password);
        $registerStmt->execute();

        if ( $registerStmt->rowCount() > 0) {
            $json = array(
                'status' => 'ok',
                'msg' => '帳密寫入成功'
            );
            $get_no = $pdo->prepare("SELECT member_no FROM member_info WHERE member_id = :member_id_assignment");
            $get_no->bindValue(":member_id_assignment", $member_id_assignment);
            $get_no->execute();
            $member_no = $get_no->fetch(PDO::FETCH_ASSOC);
            setcookie("member_no", $member_no['member_no'], time()+3600*24, "/");
            $res = json_encode($json);
            echo $res;
        } else {
            $json = array(
                'status' => 'error',
                'msg' => '帳密寫入失敗'
            );
            $res = json_encode($json);
            echo $res;
        }
    }

} catch ( PDOException $e ) {
    echo $e->getMessage();
  }


?>