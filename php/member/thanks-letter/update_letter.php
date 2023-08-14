<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3-yiiijie.php");

try {
  $thanksLetterNo = $_POST["thanks_letter_no"] ?? null;
  $childrenId = $_POST["children_id"] ?? null;
  $memberId = $_POST["member_id"] ?? null;
  $sponsorOrderId = $_POST["sponsor_order_id"] ?? null;
  $receiveDate = $_POST["receive_date"] ?? null;
  $fileName = $_FILES["file_name"] ?? null;

  // parameters validation
  if ($thanksLetterNo == null) {
    throw new InvalidArgumentException($message = "參數不足(thanks_letter_no)");
  }
  if ($childrenId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供children_id)");
  }
  if ($memberId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供member_id)");
  }
  if ($sponsorOrderId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供sponsor_order_id)");
  }
  if ($receiveDate == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供receive_date)");
  }
  if ($fileName == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供file_name)");
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
  file_name = :file_name,
  updater='星火喵喵大財團',
  update_time = Now()
  where thanks_letter_no = :thanks_letter_no ";

  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":thanks_letter_no", $thanksLetterNo);
  $updateStmt->bindValue(":children_id", $childrenId);
  $updateStmt->bindValue(":member_id", $memberId);
  $updateStmt->bindValue(":sponsor_order_id", $sponsorOrderId);
  $updateStmt->bindValue(":receive_date", $receiveDate);
  $updateStmt->bindValue(":file_name", mkFilename($thanksLetterNo, $fileName, 1));
  $updateResult = $updateStmt->execute();



  if (!$updateResult) {
    throw new UnexpectedValueException($message = "更新資料庫失敗(請聯絡管理人員)");
  }
  if (!copyFileToLocal($thanksLetterNo, $fileName, 1)) {
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
    $pdo->rollBack();
  }

  function copyFileToLocal($thanksLetterNo, $file, $fileNo)
  {
    $dir = "../../images/thanks-letter/";
    if (file_exists($dir) === false) {
      mkdir($dir);
    }

    $filename = mkFilename($thanksLetterNo, $file, $fileNo);
    $from = $file["tmp_name"];
    $to = $dir . $filename;
    return copy($from, $to);
  }

  function mkFilename($updateId, $file, $fileNo)
  {
    $filename =  'TL' . str_pad($updateId, 3, "0", STR_PAD_LEFT) . '_' . $fileNo;
    $fileExt = pathInfo($file["name"], PATHINFO_EXTENSION);
    $filename = "$filename.$fileExt";
    return $filename;
  }


