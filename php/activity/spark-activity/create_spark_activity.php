<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $sparkActivityName = $_POST["spark_activity_name"] ?? null;
  $sparkActivityDescription = $_POST["spark_activity_description"] ?? null;
  $sparkActivityStartDate = $_POST["spark_activity_start_date"] ?? null;
  $sparkActivityEndDate = $_POST["spark_activity_end_date"] ?? null;

  // parameters validation
  if ($sparkActivityName == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供spark_activity_name)");
  }
  if ($sparkActivityDescription == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供spark_activity_description)");
  }
  if ($sparkActivityStartDate == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供spark_activity_start_date)");
  }
  if ($sparkActivityEndDate == null) {
    throw new InvalidArgumentException($message = "參數不足(spark_activity_end_date)");
  }


  // create record
  $pdo->beginTransaction();


  $createSql = "insert into spark_activity(spark_activity_name, spark_activity_description, spark_activity_start_date,spark_activity_end_date,register,updater) values(:spark_activity_name, :spark_activity_description,:spark_activity_start_date,:spark_activity_end_date,'許咪咪','許咪咪')";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":spark_activity_name", $sparkActivityName);
  $createStmt->bindValue(":spark_activity_description", $sparkActivityDescription);
  $createStmt->bindValue(":spark_activity_start_date", $sparkActivityStartDate);
  $createStmt->bindValue(":spark_activity_end_date", $sparkActivityEndDate);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $updateSql = "update spark_activity set spark_activity_id = concat('SA',LPAD(LAST_INSERT_ID(), 3, 0)) where spark_activity_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from spark_activity where spark_activity_no = (select LAST_INSERT_ID())";
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
