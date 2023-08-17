<?php
require_once("../../connect_chd102g3-yiiijie.php");
// header("Access-Control-Allow-Origin: https://tibamef2e.com/chd102/g3/");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
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
        $match_sql = "SELECT * FROM member_info WHERE member_account = :member_account AND member_password = :member_password";
        $matchStmt = $pdo->prepare($match_sql);
        $matchStmt->bindValue(':member_account', $member_account);
        $matchStmt->bindValue(':member_password', $member_password);
        $matchStmt->execute();

        if ($matchStmt->rowCount() < 1) {
            $error = array(
                'status' => 'error',
                'msg' => '帳號或密碼錯誤'
            );
            $res = json_encode($error);
            echo $res;
        } else {
            $sql_id = "SELECT member_id FROM member_info WHERE member_account = :member_account"; 
            $idStmt = $pdo->prepare($sql_id);
            $idStmt->bindValue(':member_account', $member_account);
            $idStmt->execute();
            $member_id = $idStmt->fetch(PDO::FETCH_ASSOC);
            session_start();

            $_SESSION['member_id'] = $member_id['member_id'];

            $session_data = array(
                'status' => 'ok',
                'session_name' => session_name(),
                'session_id' => session_id(),
                'member_id' => $_SESSION['member_id'],
                'msg' => '登入成功'
            );
            $res = json_encode($session_data);
            echo $res;
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} 
?>