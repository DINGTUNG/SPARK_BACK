<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $sparkActivityNo = $_POST["spark_activity_no"] ?? null;
  $isSparkActivityOnline = $_POST["is_spark_activity_online"] ?? null;

  // parameters validation
  if ($sparkActivityNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供spark_activity_no)");
  }

  // update record
  $updateSql = "UPDATE
  spark_activity
SET
  updater = '許咪咪',
  update_time = NOW(), 
  is_spark_activity_online = 
  CASE 
  WHEN is_spark_activity_online = true THEN is_spark_activity_online = false 
  ELSE true
  END
WHERE
spark_activity_no = :spark_activity_no";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":spark_activity_no", $sparkActivityNo);
  $updateResult = $updateStmt->execute();
  http_response_code(200);
  echo json_encode($updateResult);
} catch (InvalidArgumentException $e) {
  http_response_code(400);
  echo $e->getMessage();
} catch (Exception $e) {
  http_response_code(500);
   echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)";
  echo $e->getMessage();
}
