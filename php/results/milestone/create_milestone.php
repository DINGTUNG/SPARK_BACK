<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $milestoneTitle = $_POST["milestone_title"] ?? null;
  $milestoneDate = $_POST["milestone_date"] ?? null;
  $milestoneContent = $_POST["milestone_content"] ?? null;
  $milestoneImage = $_FILES["milestone_image"] ?? null;
  $milestoneImageName = $_FILES["milestone_image"]['name'] ?? null;

  // parameters validation
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
  
  // create record
  $createSql = "INSERT INTO milestone
  ( 
  milestone_title, 
  milestone_date, 
  milestone_content, 
  milestone_image, 
  updater, 
  update_time) 
  VALUES
  (
  :milestone_title, 
  :milestone_date, 
  :milestone_content, 
  :milestone_image_name, 
  'Kay', 
  Now())";

  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":milestone_title", $milestoneTitle);
  $createStmt->bindValue(":milestone_date", $milestoneDate);
  $createStmt->bindValue(":milestone_content", $milestoneContent);
  $createStmt->bindValue(":milestone_image_name", $milestoneImageName);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $lastInsertId = $pdo->lastInsertId();

  $updateSql = "UPDATE
  milestone
SET
  milestone_id = CONCAT('M', LPAD(:last_insert_id, 3, 0)),
  milestone_image = :milestone_image_name
WHERE
  milestone_no = :last_insert_id";

  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":last_insert_id", $lastInsertId);
  $updateStmt->bindValue(":milestone_image_name", mkFilename($lastInsertId,$milestoneImage,$milestoneImageName));
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  if (!$updateResult) {
    throw new Exception();
  }

  if (!copyFileToLocal($lastInsertId,$milestoneImage,$milestoneImageName)) {
    throw new Exception();
  }
  
  
  $selectSql = "select * from milestone where milestone_no = (select LAST_INSERT_ID())";
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

function copyFileToLocal($lastInsertId, $milestoneImage, $milestoneImageName)
{
  $dir = "../../../images/milestone/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($lastInsertId, $milestoneImage, $milestoneImageName);
  $from = $milestoneImage["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename($lastInsertId, $milestoneImage, $milestoneImageName)
{
  $filename =  'M' . str_pad($lastInsertId, 3, "0", STR_PAD_LEFT) . '_' . 
  $milestoneImageName;
  return $filename;
}

?>
