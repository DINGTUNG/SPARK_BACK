<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3-yiiijie.php");

try {
  $childrenId = $_POST["children_id"] ?? null;
  $memberId = $_POST["member_id"] ?? null;
  $sponsorOrderId = $_POST["sponsor_order_id"] ?? null;
  $receiveDate = $_POST["receive_date"] ?? null;
  $fileName = $_POST["file_name"] ?? null;
  





  // parameters validation
  if ($childrenId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供childrenId)");
  }
  if ($memberId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供memberId)");
  }
  if ($sponsorOrderId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供sponsorOrderId)");
  }
  if ($receiveDate == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供receiveDate)");
  }
  if ($fileName == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供fileName)");
  }


  // create record
  $pdo->beginTransaction();


  $createSql = "insert into thanks_letter(children_id, member_id, sponsor_order_id, receive_date, file_name) values(:children_id, :member_id, :sponsor_order_id, :receive_date, :file_name,'阿菜')";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":children_id", $childrenId);
  $createStmt->bindValue(":member_id", $memberId);
  $createStmt->bindValue(":sponsor_order_id", $sponsorOrderId);
  $createStmt->bindValue(":receive_date", $receiveDate);
  $createStmt->bindValue(":file_name", $fileName);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $updateSql = "update thanks_letter set thanks_letter_id = concat('TL',LPAD(LAST_INSERT_ID(), 3, 0)) where thanks_letter_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from thanks_letter where thanks_letter_no = (select LAST_INSERT_ID())";
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
