<?php
require_once("../connect_chd102g3.php");
header("Access-Control-Allow-Origin: https://tibamef2e.com");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
try {
    $staff_account = $_POST['staff_account'];
    $staff_password = $_POST['staff_password'];
    

    if (empty($staff_account) || empty($staff_password)) {
        $error = array(
            'status' => 'error',
            'msg' => '請輸入帳號密碼'
        );
        $res = json_encode($error);
        echo $res;
    } else {
        $match_sql = "SELECT * FROM  cms_staff WHERE staff_account = :staff_account AND staff_password = :staff_password";
        $matchStmt = $pdo->prepare($match_sql);
        $matchStmt->bindValue(':staff_account', $staff_account);
        $matchStmt->bindValue(':staff_password', $staff_password);
        $matchStmt->execute();

        if ($matchStmt->rowCount() < 1) {
            $error = array(
                'status' => 'error',
                'msg' => '帳號或密碼錯誤'
            );
            $res = json_encode($error);
            echo $res;
        } else {
            $sql_id = "SELECT staff_no FROM cms_staff WHERE staff_account = :staff_account"; 
            $idStmt = $pdo->prepare($sql_id);
            $idStmt->bindValue(':staff_account', $staff_account);
            $idStmt->execute();
            $staff_no = $idStmt->fetch(PDO::FETCH_ASSOC);
            session_start();

            $_SESSION['staff_no'] = $staff_no['staff_no'];

            $session_data = array(
                'status' => 'ok',
                'session_name' => session_name(),
                'session_id' => session_id(),
                'staff_no' => $_SESSION['staff_no'],
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