<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $locationNo = $_POST["location_no"] ?? null;
  $locationName = $_POST["location_name"] ?? null;
  if ($locationNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供location no)");
  }
  if($locationName == null){
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

  // delete record
  $updateSql = "update sponsor_location set location_name = :location_name ,updater='sir', update_time = Now() where location_no = :location_no ";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":location_no", $locationNo);
  $updateStmt->bindValue(":location_name", $locationName);
  http_response_code(200);
  echo json_encode($updateDeleteResult);

  echo "參數不足(請提供message no)"; 
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
