<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3-yiiijie.php");

try {
  $thanksLetterNo = $_POST["thanks_letter_no"] ?? null;

  // parameters validation
  if ($thanksLetterNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供thanks letter no)");
  }

  // check delete record existed
  $checkRecordAliveSql = "select count(*) as count from thanks_letter where thanks_letter_no = :thanks_letter_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":thanks_letter_no", $thanksLetterNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // delete record
  $updateDeleteSql = "update thanks_letter set del_flg = 1,updater='星火喵喵大財團', update_time = Now() where thanks_letter_no = :thanks_letter_no ";
  $updateDeleteStmt = $pdo->prepare($updateDeleteSql);
  $updateDeleteStmt->bindValue(":thanks_letter_no", $thanksLetterNo);
  $updateDeleteResult = $updateDeleteStmt->execute();
  http_response_code(200);
  echo json_encode($updateDeleteResult);

  echo "參數不足(請提供thanks letter no)"; 
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
