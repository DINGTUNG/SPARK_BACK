<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $locationId = $_POST["location_id"] ?? null;
  $price = $_POST["price"] ?? null;
  $paymentPlan = $_POST["payment_plan"] ?? null;
  $paymentMethod = $_POST["payment_method"] ?? null;

  // parameters validation
  if ($locationId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 location_id)");
  }
  if ($price == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 price)");
  }
  if ($paymentPlan == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 payment_plan)");
  }
  if ($paymentMethod == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 payment_method)");
  }

  // create record
  $pdo->beginTransaction();


  $createSql = "INSERT INTO sponsor_order(
    member_id,
    location_id,
    sponsor_date,
    price,
    payment_plan,
    payment_method,
    expiry_date
)
VALUES(
    'A001',
    :location_id,
    now(),
    :price,
    :payment_plan,
    :payment_method,
    DATE_ADD(
        CAST(sponsor_date AS DATE),
        INTERVAL 1 YEAR
    )
)";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":location_id", $locationId);
  $createStmt->bindValue(":price", $price);
  $createStmt->bindValue(":payment_plan", $paymentPlan);
  $createStmt->bindValue(":payment_method", $paymentMethod);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }

  $lastInsertId = $pdo->lastInsertId();

  $updateSql = "UPDATE
  sponsor_order
SET
  sponsor_order_id = CONCAT('SO', LPAD(:last_insert_id, 3, 0)),
  expiry_date = DATE_ADD(
        CAST(sponsor_date AS DATE),
        INTERVAL 1 YEAR
    )
WHERE
  sponsor_order_no = :last_insert_id";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":last_insert_id", $lastInsertId);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from sponsor_order where sponsor_order_no = (select LAST_INSERT_ID())";
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
