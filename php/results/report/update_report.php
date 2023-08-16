<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


require_once("../../connect_chd102g3.php");

try {
  $reportNo = $_POST["report_no"] ?? null;
  $reportClass = $_POST["report_class"] ?? null;
  $reportYear = $_POST["report_year"] ?? null;
  $reportTitle = $_POST["report_title"] ?? null;
  $reportFile = $_FILES["report_file_path"] ?? null;


  // parameters validation
  if ($reportNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 report no)");
  }
  if ($reportClass == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 report class)");
  }
  if ($reportYear == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 report year)");
  }
  if ($reportTitle == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 report title)");
  }
  if ($reportFile == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供 report file )");
  }

  $pdo->beginTransaction();

  // check update record existed
  $checkRecordAliveSql = "SELECT COUNT(*) AS count FROM report WHERE report_no = :report_no AND del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":report_no", $reportNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  $updateSql = "UPDATE report SET
  report_class = :report_class,
  report_year = :report_year,
  report_title = :report_title,
  report_file_path = :report_file_path,
  updater = 'sir',
  update_time = NOW()
  WHERE report_no = :report_no";

  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":report_no", $reportNo);
  $updateStmt->bindValue(":report_class", $reportClass);
  $updateStmt->bindValue(":report_year", $reportYear);
  $updateStmt->bindValue(":report_title", $reportTitle);
  $updateStmt->bindValue(":report_file_path", mkFilename($reportNo, $reportFile, $reportClass));
  $updateResult = $updateStmt->execute();

  if (!$updateResult) {
    throw new UnexpectedValueException($message = "更新資料庫失敗(請聯絡管理人員)");
  }

  if (!copyFileToLocal($reportNo, $reportFile, $reportClass)) {
    throw new UnexpectedValueException($message = "檔案儲存失敗(file stored failed)");
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
  echo "狸猫正在搗亂伺服器！請聯絡後端管理員！(或地瓜教主！)";
  $pdo->rollBack();
}

function copyFileToLocal($reportNo, $file, $reportClass)
{
  $dir = "../../../PDF/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($reportNo, $file, $reportClass);
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename($updateId, $file, $reportClass)
{

  $currentYear = date('Y');
  if ($reportClass == "財務") {
    $filename = 'R' . $currentYear . '_'  . '_finance_rep';
  }else if ($reportClass == "年度") {
    $filename = 'R' . $currentYear . '_'  . '_years_rep';
  }else{
    throw new UnexpectedValueException($message = "報告種類有誤");
  }
  $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}
