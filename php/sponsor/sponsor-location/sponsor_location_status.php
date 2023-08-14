<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $locationNo = $_POST["location_no"] ?? null;
  $locationOnline = $_POST["is_sponsor_location_online"] ?? null;
  // parameters validation
  if ($locationNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供location no)");
  }
  if ($locationOnline == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供location online)");
  }

   // update record
  $updateSql = "UPDATE
  sponsor_location
SET
  updater = 'sir',
  update_time = NOW(), 
  is_sponsor_location_online = 
  CASE 
  WHEN is_sponsor_location_online = true THEN is_sponsor_location_online = false 
  ELSE true
  END
WHERE
  location_no = :location_no";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":location_no", $locationNo);
  $updateResult = $updateStmt->execute();
  http_response_code(200);
  echo json_encode($updateResult);
} catch (InvalidArgumentException $e) {
  http_response_code(400);
  echo $e->getMessage();
  
} catch (UnexpectedValueException $e) {
  http_response_code(412);
  echo $e->getMessage();
} 
catch (Exception $e) {
  http_response_code(500);
   echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)";
  echo $e->getMessage();
}
