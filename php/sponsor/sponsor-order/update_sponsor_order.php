<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $sponsorOrderNo = $_POST["sponsor_order_no"] ?? null;
  $childrenId = $_POST["children_id"] ?? null;

  // parameters validation
  if ($sponsorOrderNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 sponsor_order_no)");
  }
  if ($childrenId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 children_id)");
  }

  // check update record existed
  $checkRecordAliveSql = "select count(*) as count from sponsor_order where sponsor_order_no = :sponsor_order_no";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":sponsor_order_no", $sponsorOrderNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  $updateSql = "update sponsor_order set children_id = :children_id,updater='許咪咪', update_time = Now() where sponsor_order_no = :sponsor_order_no ";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":sponsor_order_no", $sponsorOrderNo);
  $updateStmt->bindValue(":children_id", $childrenId);

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
  echo $e->getMessage();
}
