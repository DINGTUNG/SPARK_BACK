<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require_once("../../connect_chd102g3.php");
try {
    $reportClass = $_POST["report_class"] ?? null;
    $reportYear = $_POST["report_year"] ?? null;
    $reportTitle = $_POST["report_title"] ?? null;
    $reportsFile = $_FILES["reports_file_path"] ?? null;

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
  if ($reportsFile == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供reports ile path)");
  }
  $pdo->beginTransaction();


  // update record
  $createSql = "insert into reports
  (report_class,
  report_year,
  report_title,
  reports_file_path,
  updater,
  update_time,
  report_no) 
  values
  (:report_class,
    :report_year,
    :report_title,
    :reports_file_path,
    'sir',
    Now(),
    :report_no)";

  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":report_no",$reportNo);
  $createStmt->bindValue(":report_class",$reportClass);
  $createStmt->bindValue(":report_title",$reportTitle);
  $createStmt->bindValue(":report_year", $reportYear);
  $createStmt->bindValue(":reports_file_path", mkFilename($reportNo, $reportsFile, 1,$reportClass));
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  if (!copyFileToLocal($reportNo, $reportsFile, 1)) {
    throw new Exception();
  }

  $updateSql = "update reports set report_id = concat('R',LPAD(LAST_INSERT_ID(), 3, 0)) where report_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from reports where report_no = (select LAST_INSERT_ID())";
  $selectStmt = $pdo->query($selectSql);
  $newMessage = $selectStmt->fetch
  (PDO::FETCH_ASSOC);
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
  $pdo->rollBack();
}

function copyFileToLocal($reportNo,$file,$fileNo)
{
  $dir = "../../../PDF/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($reportNo,$file,$fileNo,$reportClass);
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
  
}

function mkFilename($updateId, $file, $fileNo, $reportClass)
{
  $currentYear = date('Y');
  if ($reportClass == "年度") {
    $filename = 'R' . $currentYear . '_' . $fileNo . '_finance_rep';
  } else {
    $filename = 'R' . $currentYear . '_' . $fileNo . '_business_rep';
  }
  $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}
?>