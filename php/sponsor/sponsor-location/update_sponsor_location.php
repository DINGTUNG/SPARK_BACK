<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


require_once("../../connect_chd102g3.php");

try {
  $locationNo = $_POST["location_no"] ?? null;
  $locationName = $_POST["location_name"] ?? null;
 
  // parameters validation
  if ($locationNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供location no)");
  }
  if ($locationName == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供location name)");
  }

  // check update record existed
  $checkRecordAliveSql = "select count(*) as count from sponsor_location where location_no = :location_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":location_no", $locationNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  $updateSql = "update sponsor_location set location_name = :location_name, updater='sir', update_time = Now() where location_no = :location_no ";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":location_no", $locationNo);
  $updateStmt->bindValue(":location_name", $locationName);
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
