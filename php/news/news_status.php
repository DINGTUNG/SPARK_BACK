<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

try {
  $newsNo = $_POST["news_no"] ?? null;
  $newsOnline = $_POST["is_news_online"] ?? null;
  // parameters validation
  if ($newsNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news no)");
  }
  if ($newsOnline == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news online)");
  }

   // update record
  $updateSql = "UPDATE
  news
SET
  updater = 'sir',
  update_time = NOW(), 
  is_news_online = 
  CASE 
  WHEN is_news_online = true THEN is_news_online = false 
  ELSE true
  END
WHERE
  news_no = :news_no";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":news_no", $newsNo);
  $updateResult = $updateStmt->execute();
  http_response_code(200);
  echo json_encode($updateResult);
} catch (InvalidArgumentException $e) {
  http_response_code(400);
  echo $e->getMessage();
  
} catch (UnexpectedValueException $e) {
  http_response_code(412);
  echo $e->getMessage();
} 
catch (Exception $e) {
  http_response_code(500);
   echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)";
  echo $e->getMessage();
}
