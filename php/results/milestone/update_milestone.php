<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");


//從 POST 請求中獲取傳遞過來的參數
try {
  $milestoneNo = $_POST["milestone_no"] ?? null;
  $milestoneTitle = $_POST["milestone_title"] ?? null;
  $milestoneDate = $_POST["milestone_date"] ?? null;
  $milestoneContent = $_POST["milestone_content"] ?? null;
  $milestoneImage = $_POST["milestone_image"] ?? null;

  // parameters validation 驗證確保必要的參數已提供
  if ($milestoneNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供milestone no)");
  }
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

  // check update record existed
  // 檢查 milestone 表中是否存在指定的 milestone_no，並且 del_flg 的值為 0（表示未被刪除）
  $checkRecordAliveSql = "select count(*) as count from milestone where milestone_no = :milestone_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":milestone_no", $milestoneNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  // 更新 milestone 表中指定內容，基於 milestone_no 進行查找
  $updateSql = "update milestone set milestone_title = :milestone_title, milestone_date = :milestone_date, milestone_content = :milestone_content, milestone_image = :milestone_image, updater='Kay', update_time = Now() where milestone_no = :milestone_no ";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":milestone_no", $milestoneNo);
  $updateStmt->bindValue(":milestone_title", $milestoneTitle);
  $updateStmt->bindValue(":milestone_date", $milestoneDate);
  $updateStmt->bindValue(":milestone_content", $milestoneContent);
  $updateStmt->bindValue(":milestone_image", $milestoneImage);
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
}
