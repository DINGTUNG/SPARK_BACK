<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");


//從 POST 請求中獲取傳遞過來的參數
try {
  $milestoneNo = $_POST["milestone_no"] ?? null;
  $milestoneTitle = $_POST["milestone_title"] ?? null;
  $milestoneDate = $_POST["milestone_date"] ?? null;
  $milestoneContent = $_POST["milestone_content"] ?? null;
  $milestoneImage = $_FILES["milestone_image"] ?? null;
  $milestoneImageName = $_FILES["milestone_image"]['name'] ?? null;

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

  $pdo->beginTransaction();

  // check update record existed
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
  $updateSql = "update milestone set 
  milestone_title = :milestone_title, 
  milestone_date = :milestone_date, 
  milestone_content = :milestone_content, 
  milestone_image = :milestone_image_name, 
  updater='Kay', 
  update_time = Now() 
  where milestone_no = :milestone_no ";

  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":milestone_no", $milestoneNo);
  $updateStmt->bindValue(":milestone_title", $milestoneTitle);
  $updateStmt->bindValue(":milestone_date", $milestoneDate);
  $updateStmt->bindValue(":milestone_content", $milestoneContent);
  $updateStmt->bindValue(":milestone_image_name", mkFilename($milestoneNo,$milestoneImage,$milestoneImageName));

  $updateResult = $updateStmt->execute();


  if (!$updateResult) {
    throw new UnexpectedValueException($message = "更新資料庫失敗(請聯絡管理人員)");
  }
  if (!copyFileToLocal($milestoneNo,$milestoneImage,$milestoneImageName)) {
    throw new UnexpectedValueException($message = "檔案儲存失敗(copy failed)");
  }
  $pdo->commit();
  http_response_code(200);
  echo json_encode($updateResult);
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
<<<<<<< HEAD
  echo $e;
=======
  echo $e->getMessage();
>>>>>>> d274fa03f9caaf3f15b61a5a0b3a04352a17c898
  $pdo->rollBack();
}

function copyFileToLocal($milestoneNo, $milestoneImage, $milestoneImageName)
{
  $dir = "../../../images/milestone/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($milestoneNo, $milestoneImage, $milestoneImageName);
  $from = $milestoneImage["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename($updateId, $milestoneImage, $milestoneImageName)
{
  $filename =  'M' . str_pad($updateId, 3, "0", STR_PAD_LEFT) . '_' . 
  $milestoneImageName;
  return $filename;
}

