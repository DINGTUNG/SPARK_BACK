<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../connect_chd102g3.php");

try {
  $staffNo = $_POST["staff_no"] ?? null;
  $staffAccount = $_POST["staff_account"] ?? null;
  $staffPassword = $_POST["staff_password"] ?? null;

  // parameters validation
  if ($staffNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供staff no)");
  }
  if ($staffAccount == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供staff account)");
  }
    if ($staffPassword == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供staff password)");
  }

  // check update record existed
  $checkRecordAliveSql = "select count(*) as count from cms_staff where staff_no = :staff_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":staff_no", $staffNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  $updateSql = "update cms_staff set staff_account = :staff_account, staff_password = :staff_password, updater='董杯杯', update_time = Now() where staff_no = :staff_no ";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":staff_no", $staffNo);
  $updateStmt->bindValue(":staff_account", $staffAccount);
  $updateStmt->bindValue(":staff_password", $staffPassword);
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
