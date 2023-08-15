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
  
  // create record
  $pdo->beginTransaction();

  $createSql = "insert into milestone(milestone_no, milestone_title, 
  milestone_date, milestone_content, milestone_image, updater, update_time) values(:milestone_no, :milestone_title, :milestone_date, :milestone_content, :milestone_image, 'Kay', Now())";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":milestone_no", $milestoneNo);
  $createStmt->bindValue(":milestone_title", $milestoneTitle);
  $createStmt->bindValue(":milestone_date", $milestoneDate);
  $createStmt->bindValue(":milestone_content", $milestoneContent);
  $createStmt->bindValue(":milestone_image", mkFilename($milestoneNo, $milestoneImage,1));

  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  if (!copyFileToLocal($milestoneNo, $milestoneImage, 1)) {
    throw new Exception();
  }
  $updateSql = "update milestone set milestone_id = concat('M',LPAD(LAST_INSERT_ID(), 3, 0)) where milestone_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

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

function copyFileToLocal($milestoneNo, $file, $fileNo)
{
  $dir = "../../../images/milestone/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($milestoneNo, $file, $fileNo);
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename($milestoneNo, $file, $fileNo)
{
  $filename =  'M' . str_pad($updateId, 3, "0", STR_PAD_LEFT) . '_' . 
  $fileNo;
  $fileExt = pathInfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}

?>
