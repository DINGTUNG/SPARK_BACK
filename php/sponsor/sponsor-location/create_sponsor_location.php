<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $locationContent = $_POST["location_name"] ?? null;

  // parameters validation
  if ($locationContent == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供location_name)");
  }

  // create record
  $pdo->beginTransaction();


  $createSql = "insert into sponsor_location( location_name,updater) values(:location_name,'許咪咪')";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue("location_name", $locationContent);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $updateSql = "update sponsor_location set location_id = concat('SL',LPAD(LAST_INSERT_ID(), 3, 0)) where location_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from sponsor_location where location_no = (select LAST_INSERT_ID())";
  $selectStmt = $pdo->query($selectSql);
  $newMessage = $selectStmt->fetch(PDO::FETCH_ASSOC);
  http_response_code(200);
  echo json_encode($newMessage);
} catch (InvalidArgumentException $e) {
  http_response_code(400);
  echo $e->getMessage();
  $pdo->rollBack();
} catch (UnexpectedValueException $e) {
  http_response_code(412);
  echo $e->getMessage();
  $pdo->rollBack();
} catch (Exception $e) {
  http_response_code(500);
  echo $e;
  $pdo->rollBack();
}
