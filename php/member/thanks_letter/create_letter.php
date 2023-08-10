<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3-yiiijie.php");

try {
  $letterContent = $_POST["letter_content"] ?? null;

  // parameters validation
  if ($messageContent == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供message content)");
  }

  // create record
  $pdo->beginTransaction();


  $createSql = "insert into message_board(spark_activity_id, message_content, member_id,updater) values('SA001', :message_content,'A087','許咪咪')";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":message_content", $messageContent);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $updateSql = "update message_board set message_id = concat('SM',LPAD(LAST_INSERT_ID(), 3, 0)) where message_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from message_board where message_no = (select LAST_INSERT_ID())";
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
