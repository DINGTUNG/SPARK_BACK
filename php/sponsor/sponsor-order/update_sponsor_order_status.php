<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $sponsorOrderNo = $_POST["sponsor_order_no"] ?? null;
  $orderStatus = $_POST["order_status"] ?? null;

  // parameters validation
  if ($sponsorOrderNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供sponsor order no)");
  }

  // update record
  $updateSql = "UPDATE
  sponsor_order
SET
  updater = '許咪咪',
  update_time = NOW(), 
  order_status = 
  CASE 
  WHEN order_status = true THEN order_status = false 
  ELSE true
  END
WHERE
  sponsor_order_no = :sponsor_order_no";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":sponsor_order_no", $sponsorOrderNo);
  $updateResult = $updateStmt->execute();
  http_response_code(200);
  echo json_encode($updateResult);
} catch (InvalidArgumentException $e) {
  http_response_code(400);
  echo $e->getMessage();
} catch (Exception $e) {
  http_response_code(500);
  echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)";
}
