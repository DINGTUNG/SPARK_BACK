<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $messageNo = $_POST["message_no"] ?? null;

  // parameters validation
  if ($messageNo == null) {
    throw new InvalidArgumentException($error);
  }

  // check delete record existed
  $checkRecordAliveSql = "select count(*) as count from message_board where message_no = :message_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":message_no", $messageNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($error);
  }

  // delete record
  $updateDeleteSql = "update message_board set del_flg = 1,updater='許咪咪', update_time=Now() where message_no = :message_no ";
  $updateDeleteStmt = $pdo->prepare($updateDeleteSql);
  $updateDeleteStmt->bindValue(":message_no", $messageNo);
  $updateDeleteResult = $updateDeleteStmt->execute();
  http_response_code(200);
  echo json_encode($updateDeleteResult);

} catch (InvalidArgumentException $e) {
  // $msg = "錯誤行號 : " . $e->getLine() . ", 錯誤訊息 : " . $e->getMessage();
  http_response_code(400);
  echo "參數不足(請提供message no)"; 
} catch (UnexpectedValueException $e) {
  // $msg = "錯誤行號 : " . $e->getLine() . ", 錯誤訊息 : " . $e->getMessage();
  http_response_code(412);
  // echo "找不到刪除資料或資料已被刪除"; 

  $arr = array('message' => '狸猫壞'); //etc
  echo json_encode($arr);




} catch (Exception $e) {
  // $msg = "錯誤行號 : " . $e->getLine() . ", 錯誤訊息 : " . $e->getMessage();
  http_response_code(500);
  echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)"; 
}
