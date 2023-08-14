<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $dreamStarNo = $_POST["dream_star_no"] ?? null;

  // parameters validation
  if ($dreamStarNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供dream_star_no)");
  }

  // check update record existed
  $checkRecordAliveSql = "select count(*) as count from dream_star where dream_star_no = :dream_star_no and del_flg = 0 and is_dream_star_online = 1";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":dream_star_no", $dreamStarNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  $updateSql = "UPDATE
  dream_star
SET
  dream_star_votes = dream_star_votes + 1
WHERE
  dream_star_no = :dream_star_no";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":dream_star_no", $dreamStarNo);

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
