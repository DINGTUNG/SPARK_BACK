<?php
require_once("../../connect_chd102g3.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

try {
    $member_account = $_POST['member_account'];
    $member_password = $_POST['member_password'];

    if (empty($member_account)) {
        $error = array(
            'status' => 'error',
            'msg' => '請輸入帳號'
        );
        $res = json_encode($error);
        echo $res;
    } else {
        $sql_reset = "UPDATE `member_info` SET `member_password` = :member_password WHERE `member_account` = :member_account";
        $resetStmt = $pdo->prepare($sql_reset);
        $resetStmt->bindValue(":member_account", $member_account);
        $resetStmt->bindValue(":member_password", $member_password);
        $resetStmt->execute();

        $affectedRows = $resetStmt->rowCount();

        if ($affectedRows > 0) {
            $json = array(
                'status' => 'ok',
                'msg' => '密碼寫入成功',
            );
        } else {
            $json = array(
                'status' => 'error',
                'msg' => '密碼寫入失敗',
            );
        }

        $res = json_encode($json);
        echo $res;
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
