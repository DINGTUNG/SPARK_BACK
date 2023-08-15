<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {

  $donateNo =  $_POST["donate_project_no"] ?? null;
  $donateName = $_POST["donate_project_name"] ?? null;
  $donateStartDate = $_POST["donate_project_start_date"] ?? null;
  $donateEndDate = $_POST["donate_project_end_date"] ?? null;
  $donateSummarize = $_POST["donate_project_summarize"] ?? null;
  $donateImage = $_FILES["donate_project_image"] ?? null;

  // parameters validation
  if ($donateNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供donate project no)");
  }
  if ($donateName == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供donate project name)");
  }
  if ($donateStartDate == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供donate project start date)");
  }
  if ($donateEndDate == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供donate project end date)");
  }
  if ($donateSummarize == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供donate project summarize)");
  }
  if ($donateImage == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供donate project image)");
  }

  $pdo->beginTransaction();

  // check update record existed
  $checkRecordAliveSql = "select count(*) as count from donate_project where donate_project_no = :donate_project_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":donate_project_no", $donateNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  $updateSql = "update donate_project set
  donate_project_name = :donate_project_name, 
  donate_project_start_date = :donate_project_start_date,
  donate_project_end_date = :donate_project_end_date,
  donate_project_summarize = :donate_project_summarize,
  donate_project_image = :donate_project_image,
  updater='董杯杯', 
  update_time = Now()
  where donate_project_no = :donate_project_no ";

  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":donate_project_no", $donateNo);
  $updateStmt->bindValue(":donate_project_start_date",$donateStartDate);
  $updateStmt->bindValue(":donate_project_end_date", $donateEndDate);
  $updateStmt->bindValue(":donate_project_summarize", $donateSummarize);
  $updateStmt->bindValue(":donate_project_image", mkFilename($donateNo, $donateImage, 1));

  $updateResult = $updateStmt->execute();



  if (!$updateResult) {
    throw new UnexpectedValueException($message = "更新資料庫失敗(請聯絡管理人員)");
  }
  if (!copyFileToLocal($donateNo, $donateImage, 1)) {
    throw new UnexpectedValueException($message = "檔案1儲存失敗(copy failed)");
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
  echo $e->getMessage();
  $pdo->rollBack();
}

function copyFileToLocal($donateNo, $file, $fileNo)
{
  $dir = "../../images/donate-project/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($donateNo, $file, $fileNo);
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename($updateId, $file, $fileNo)
{
  $filename =  'DP' . str_pad($updateId, 3, "0", STR_PAD_LEFT) . '_' . $fileNo;
  $fileExt = pathInfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}





