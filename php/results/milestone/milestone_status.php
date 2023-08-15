<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $milestoneNo = $_POST["milestone_no"] ?? null;
  $milestoneOnline = $_POST["is_milestone_online"] ?? null;
  // parameters validation
  if ($milestoneNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供milestone no)");
  }
  if ($milestoneOnline == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供milestone online)");
  }

   // update record
  $updateSql = "UPDATE
  milestone
SET
  is_milestone_online = 
  CASE 
  WHEN is_milestone_online = true THEN is_milestone_online = false 
  ELSE true
  END
WHERE
  milestone_no = :milestone_no";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":milestone_no", $milestoneNo);
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
