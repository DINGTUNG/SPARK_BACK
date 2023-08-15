<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../../connect_chd102g3.php");

try {

  $donateName = $_POST["donate_project_name"] ?? null;
  $donateStartDate = $_POST["donate_project_start_date"] ?? null;
  $donateEndDate = $_POST["donate_project_end_date"] ?? null;
  $donateSummarize = $_POST["donate_project_summarize"] ?? null;
  $donateImage = $_FILES["donate_project_image"] ?? null;

  // parameters validation
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
  

  // create record
  $pdo->beginTransaction();

  $createSql = "insert into donate_project(donate_project_no, donate_project_name,donate_project_start_date, donate_project_end_date, donate_project_summarize, donate_project_image, updater, update_time) values(:donate_project_no, :donate_project_name, :donate_project_start_date, :donate_project_end_date, :donate_project_summarize, :donate_project_image, '董杯杯', Now())";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":donate_project_no", $donateNo);
  $createStmt->bindValue(":donate_project_name", $donateName);
  $createStmt->bindValue(":donate_project_start_date", $donateStartDate);
  $createStmt->bindValue(":donate_project_end_date", $donateEndDate);
  $createStmt->bindValue(":donate_project_summarize", $donateSummarize);
  $createStmt->bindValue(":donate_project_image", mkFilename($donateNo, $donateImage, 1));

  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  if (!copyFileToLocal($donateNo, $donateImage, 1)) {
    throw new Exception();
  }
  $updateSql = "update donate_project set donate_project_id = concat('DP',LPAD(LAST_INSERT_ID(), 3, 0)) where donate_project_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from donate_project where donate_project_no = (select LAST_INSERT_ID())";
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
   echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)";
  echo $e->getMessage();
  $pdo->rollBack();
}


function copyFileToLocal($donateNo, $file, $fileNo)
{
  $dir = "../../../images/donate-project/";
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

?>