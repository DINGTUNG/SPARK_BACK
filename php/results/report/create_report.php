<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Origin: https://tibamef2e.com");//緯育
// header("Access-Control-Allow-Origin: http://localhost:5174");//本地端
require_once("../../connect_chd102g3.php");
try {
  $reportClass = $_POST["report_class"] ?? null;
  $reportYear = $_POST["report_year"] ?? null;
  $reportTitle = $_POST["report_title"] ?? null;
  $reportFile = $_FILES["report_file_path"] ?? null;

  // parameters validation
  if ($reportClass == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供report class)");
  }
  if ($reportYear == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供report year)");
  }
  if ($reportTitle == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供report title)");
  }
  if ($reportFile == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供report ile path)");
  }
  $pdo->beginTransaction();

  // update record
  $createSql = "INSERT INTO report
  (report_class,
  report_year,
  report_title,
  report_file_path,
  updater,
  update_time) 
  VALUES
  (:report_class,
    :report_year,
    :report_title,
    :report_file_path,
    'sir',
    Now())";

  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":report_class", $reportClass);
  $createStmt->bindValue(":report_year", $reportYear);
  $createStmt->bindValue(":report_title", $reportTitle);
  $createStmt->bindValue(":report_file_path", mkFilename($reportFile, $reportClass));
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  if (!copyFileToLocal($reportFile, $reportClass)) {
    throw new Exception();
  }

  $updateSql = "update report set report_id = concat('R',LPAD(LAST_INSERT_ID(), 3, 0)) where report_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from report where report_no = (select LAST_INSERT_ID())";
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

function copyFileToLocal($file, $reportClass)
{
  $dir = "../../../PDF/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($file, $reportClass);
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename($file, $reportClass)
{
  $currentYear = date('Y');
  if ($reportClass == "財務") {
    $filename = 'R' . $currentYear . '_'  . '_finance_rep';
  } else {
    $filename = 'R' . $currentYear . '_' . '_years_rep';
  }
  $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}
