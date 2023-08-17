<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// require_once("../../connect_chd102g3-yiiijie.php");
require_once("../../connect_chd102g3.php");


try {
  $thanksLetterNo = $_POST["thanks_letter_no"] ?? null;
  $childrenId = $_POST["children_id"] ?? null;
  $memberId = $_POST["member_id"] ?? null;
  $sponsorOrderId = $_POST["sponsor_order_id"] ?? null;
  $receiveDate = $_POST["receive_date"] ?? null;
  $thanksLetterFile = $_FILES["thanks_letter_file"] ?? null;
  $thanksLetterFileName = $_FILES["thanks_letter_file"]['name'] ?? null;

  // parameters validation
  if ($thanksLetterNo == null) {
    throw new InvalidArgumentException($message = "參數不足(thanks_letter_no)");
  }
  if ($childrenId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供兒童ID)");
  }
  if ($memberId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供會員ID)");
  }
  if ($sponsorOrderId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供認養訂單ID)");
  }
  if ($receiveDate == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供收件日期)");
  }
  if ($thanksLetterFile == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供感謝函圖檔)");
  }

  $pdo->beginTransaction();

  // check update record existed
  $checkRecordAliveSql = "select count(*) as count from thanks_letter where thanks_letter_no = :thanks_letter_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":thanks_letter_no", $thanksLetterNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  $updateSql = "update thanks_letter set
  children_id = :children_id,
  member_id = :member_id,
  sponsor_order_id = :sponsor_order_id,
  receive_date = :receive_date,
  thanks_letter_file = :thanks_letter_file_name,
  updater='星火喵喵大財團',
  update_time = Now()
  where thanks_letter_no = :thanks_letter_no ";

  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":thanks_letter_no", $thanksLetterNo);
  $updateStmt->bindValue(":children_id", $childrenId);
  $updateStmt->bindValue(":member_id", $memberId);
  $updateStmt->bindValue(":sponsor_order_id", $sponsorOrderId);
  $updateStmt->bindValue(":receive_date", $receiveDate);
  $updateStmt->bindValue(":thanks_letter_file_name",  $thanksLetterFileName);
  $updateResult = $updateStmt->execute();



  if (!$updateResult) {
    throw new UnexpectedValueException($message = "更新資料庫失敗(請聯絡管理人員)");
  }
  if (!copyFileToLocal($thanksLetterFile, $thanksLetterFileName)) {
    throw new UnexpectedValueException($message = "圖檔儲存失敗(copy failed)");
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

function copyFileToLocal($thanksLetterFile, $thanksLetterFileName)
{
  $dir = "../../../images/thanks-letter/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $from = $thanksLetterFile["tmp_name"];
  $to = $dir . $thanksLetterFileName;
  return copy($from, $to);
}

// 用不到了
  // function mkFilename($updateId, $file, $fileNo)
  // {
  //   $filename =  'TL' . str_pad($updateId, 3, "0", STR_PAD_LEFT) . '_' . $fileNo;
  //   $fileExt = pathInfo($file["name"], PATHINFO_EXTENSION);
  //   $filename = "$filename.$fileExt";
  //   return $filename;
  // }
