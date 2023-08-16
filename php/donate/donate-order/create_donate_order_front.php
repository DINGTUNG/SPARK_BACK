<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $donateProjectId = $_POST["donate_project_id"] ?? null;
  $donateProjectName = $_POST["donate_project_name"] ?? null;
  $donatePrice = $_POST["donate_price"] ?? null;


  // parameters validation
  if ($donateProjectId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 donate_project_id)");
  }
  if ($donateProjectName == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 donate_project_name)");
  }
  if ($donatePrice == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 donate_price)");
  }


  // create record
  $pdo->beginTransaction();


  $createSql = "INSERT INTO donate_order(
    member_id,
    donate_project_id,
    donate_project_name,
    donate_price,
    donate_time
)
VALUES(
    'A001',
    :donate_project_id,
    :donate_project_name,
    :donate_price,
    now()
)";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":donate_project_id", $donateProjectId);
  $createStmt->bindValue(":donate_project_name", $donateProjectName);
  $createStmt->bindValue(":donate_price", $donatePrice);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }

  $lastInsertId = $pdo->lastInsertId();

  $updateSql = "UPDATE
  donate_order
SET
donate_order_id = CONCAT('DO', LPAD(:last_insert_id, 3, 0))
WHERE
  donate_order_no = :last_insert_id";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":last_insert_id", $lastInsertId);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from donate_order where donate_order_no = (select LAST_INSERT_ID())";
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
