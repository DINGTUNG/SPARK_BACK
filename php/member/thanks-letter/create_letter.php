<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// require_once("../../connect_chd102g3-yiiijie.php");
require_once("../../connect_chd102g3.php");

try {
  $childrenId = $_POST["children_id"] ?? null;
  $memberId = $_POST["member_id"] ?? null;
  $sponsorOrderId = $_POST["sponsor_order_id"] ?? null;
  $receiveDate = $_POST["receive_date"] ?? null;
  $thanksLetterFile = $_FILES["thanks_letter_file"] ?? null;
  $thanksLetterFileName = $_FILES["thanks_letter_file"]['name'] ?? null;

  // parameters validation
  if ($childrenId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供兒童ID)");
  }
  if ($memberId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供會員ID)");
  }
  if ($sponsorOrderId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供認養訂單ID)");
  }
  if ($receiveDate == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供收件日期)");
  }
  if ($thanksLetterFile == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供感謝函圖檔)");
  }

  // create record
  $pdo->beginTransaction();

  $createSql = "insert into thanks_letter(children_id, member_id, sponsor_order_id, receive_date, thanks_letter_file, updater,  update_time) values(:children_id, :member_id, :sponsor_order_id, :receive_date, :thanks_letter_file_name, '星火喵喵大財團', Now())";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":children_id", $childrenId);
  $createStmt->bindValue(":member_id", $memberId);
  $createStmt->bindValue(":sponsor_order_id", $sponsorOrderId);
  $createStmt->bindValue(":receive_date", $receiveDate);
  $createStmt->bindValue(":thanks_letter_file_name",  $thanksLetterFileName);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $lastInsertId = $pdo->lastInsertId();

  $updateSql = "UPDATE
  thanks_letter
SET
  thanks_letter_id = CONCAT('TL', LPAD(LAST_INSERT_ID(), 3, 0))
WHERE
  thanks_letter_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  if (!$updateResult) {
    throw new Exception();
  }

  if (!copyFileToLocal($thanksLetterFile, $thanksLetterFileName)) {
    throw new UnexpectedValueException($message = "圖檔新增失敗(copy failed)");
  }

  $selectSql = "select * from thanks_letter where thanks_letter_no = (select LAST_INSERT_ID())";
  $selectStmt = $pdo->query($selectSql);
  $newLetter = $selectStmt->fetch(PDO::FETCH_ASSOC);
  http_response_code(200);
  echo json_encode($newLetter);
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
  echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)";
  echo $e->getMessage();
  $pdo->rollBack();
}

function copyFileToLocal($thanksLetterFile, $thanksLetterFileName)
{
  $dir = "../../../images/thanks-letter/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $from = $thanksLetterFile["tmp_name"];
  $to = $dir . $thanksLetterFileName;
  return copy($from, $to);
}
