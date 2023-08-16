<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


require_once("../../connect_chd102g3.php");

try {
  $reportNo = $_POST["report_no"] ?? null;
  $reportOnline = $_POST["is_report_online"] ?? null;
  // parameters validation
  if ($reportNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供report no)");
  }
  if ($reportOnline == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供report online)");
  }

   // update record
  $updateSql = "UPDATE
  report
SET
  updater = 'sir',
  update_time = NOW(), 
  is_report_online = 
  CASE 
  WHEN is_report_online = true THEN is_report_online = false 
  ELSE true
  END
WHERE
  report_no = :report_no";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":report_no", $reportNo);
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
?>
