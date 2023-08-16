<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// require_once("../../connect_chd102g3-yiiijie.php");
require_once("../../connect_chd102g3.php");


try {
  $thanksLetterNo = $_POST["thanks_letter_no"] ?? null;
  $isThanksLetterSent = $_POST["is_thanks_letter_sent"] ?? null;

  // parameters validation
  if ($thanksLetterNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供thanks_letter_no)");
  }

  // update record
  $updateSql = "UPDATE
  thanks_letter
SET
  updater = '星火喵喵大財團',
  update_time = NOW(), 
  is_thanks_letter_sent = 
  CASE 
  WHEN is_thanks_letter_sent = true THEN is_thanks_letter_sent = false 
  ELSE true
  END
WHERE
  thanks_letter_no = :thanks_letter_no";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":thanks_letter_no", $thanksLetterNo);
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
