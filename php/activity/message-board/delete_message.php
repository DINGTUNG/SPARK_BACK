<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../connect_chd102g3.php");

try {
  $messageNo = $_POST["message_no"];

  $checkRecordAliveSql = "select count(*) as count from message_board where message_no = :message_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":message_no", $messageNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  // echo json_encode($checkResult[0]['count']);

  $isExisted = $checkResult[0]['count'] != 0;
  // echo json_encode($isExisted);

  if ($isExisted) {
    $updateDeleteSql = "update message_board set del_flg = 1,updater='許咪咪', update_time=Now() where message_no = :message_no ";
    $updateDeleteStmt = $pdo->prepare($updateDeleteSql);
    $updateDeleteStmt->bindValue(":message_no", $messageNo);
    $updateDeleteResult = $updateDeleteStmt->execute();

    echo json_encode($updateDeleteResult);
  } else {
    echo false; //message no not found
    // throw new Exception("Message no " . $messageNo . " not found!");
  }
  
} catch (PDOException $e) {
  $msg = "錯誤行號 : " . $e->getLine() . ", 錯誤訊息 : " . $e->getMessage();
}
