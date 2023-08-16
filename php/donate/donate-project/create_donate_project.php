<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
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

  $createSql = "INSERT INTO donate_project(donate_project_name, donate_project_start_date, donate_project_end_date, donate_project_summarize, donate_project_image, updater, update_time) VALUES(:donate_project_name, :donate_project_start_date, :donate_project_end_date, :donate_project_summarize, :donate_project_image, '董杯杯', Now())";
  
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":donate_project_name", $donateName);
  $createStmt->bindValue(":donate_project_start_date", $donateStartDate);
  $createStmt->bindValue(":donate_project_end_date", $donateEndDate);
  $createStmt->bindValue(":donate_project_summarize", $donateSummarize);
  $createStmt->bindValue(":donate_project_image", mkFilename('temp', $donateImage));

  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }

  $lastInsertId = $pdo->lastInsertId();

  $updateSql = "UPDATE donate_project SET
  donate_project_id = CONCAT('DP', LPAD(:last_insert_id, 3, 0)),
  donate_project_image =:donate_project_image,
  updater = '董杯杯',
  update_time = Now()
WHERE
  donate_project_no = :last_insert_id";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":last_insert_id", $lastInsertId);
  $updateStmt->bindValue(":donate_project_image", mkFilename($lastInsertId, $donateImage));
    $updateResult = $updateStmt->execute();
  $pdo->commit();

  if (!$updateResult) {
    throw new Exception();
  }
  if (!copyFileToLocal($lastInsertId, $donateImage)) {
    throw new Exception();
  }
  

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


function copyFileToLocal($lastInsertId, $file)
{
  $dir = "../../../images/donate-project/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($lastInsertId, $file);
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename($lastInsertId, $file)
{
  $filename =  'DP' . str_pad($lastInsertId, 3, "0", STR_PAD_LEFT);
  $fileExt = pathInfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}

?>