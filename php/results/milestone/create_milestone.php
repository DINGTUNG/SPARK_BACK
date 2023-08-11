<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $milestoneTitle = $_POST["milestone_title"] ?? null;
  $milestoneDate = $_POST["milestone_date"] ?? null;
  $milestoneContent = $_POST["milestone_content"] ?? null;
  $milestoneImage = $_POST["milestone_image"] ?? null;

  // parameters validation
  if ($milestoneTitle == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供milestone title)");
  }
  if ($milestoneDate == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供milestone date)");
  }
  if ($milestoneContent == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供milestone content)");
  }
  if ($milestoneImage == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供milestone image)");
  }

  // create record
  $pdo->beginTransaction();


  $createSql = "insert into milestone(milestone_title, milestone_date, milestone_content,milestone_image,updater) values(:milestone_title, :milestone_date, :milestone_content, :milestone_image, 'Kay')";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":milestone_title", $milestoneTitle);
  $createStmt->bindValue(":milestone_date", $milestoneDate);
  $createStmt->bindValue(":milestone_content", $milestoneContent);
  $createStmt->bindValue(":milestone_image", $milestoneImage);

  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $updateSql = "update milestone set milestone_id = concat('M',LPAD(LAST_INSERT_ID(), 3, 0)) where milestone_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from milestone where milestone_no = (select LAST_INSERT_ID())";
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
