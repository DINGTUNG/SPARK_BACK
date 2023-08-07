<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $messageNo = $_POST["message_no"] ?? null;
  $messageContent = $_POST["message_content"] ?? null;
  // parameters validation
  if ($messageNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供message no)");
  }
  if ($messageContent == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供message content)");
  }

  // check update record existed
  $checkRecordAliveSql = "select count(*) as count from message_board where message_no = :message_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":message_no", $messageNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  $updateSql = "update message_board set message_content = :message_content,updater='許咪咪', update_time=Now() where message_no = :message_no ";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":message_content", $messageContent);
  $updateStmt->bindValue(":message_no", $messageNo);
  $updateResult = $updateStmt->execute();
  http_response_code(200);
  echo json_encode($updateResult);
} catch (InvalidArgumentException $e) {
  http_response_code(400);
  echo $e->getMessage();
} catch (UnexpectedValueException $e) {
  http_response_code(412);
  echo $e->getMessage();
  
} catch (Exception $e) {
  http_response_code(500);
  echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)";
}
