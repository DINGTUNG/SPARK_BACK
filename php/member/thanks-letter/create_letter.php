<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3-yiiijie.php");

try {
  $childrenId = $_POST["children_id"] ?? null;
  $memberId = $_POST["member_id"] ?? null;
  $sponsorOrderId = $_POST["sponsor_order_id"] ?? null;
  $receiveDate = $_POST["receive_date"] ?? null;
  $fileName = $_FILES["file_name"] ?? null;
  

  // parameters validation
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
  if ($fileName == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供感謝函圖檔)");
  }


  // create record
  $pdo->beginTransaction();


  $createSql = "insert into thanks_letter(children_id, member_id, sponsor_order_id, receive_date, file_name, register, updater) values(:children_id, :member_id, :sponsor_order_id, :receive_date, :file_name, '星火阿菜', '星火喵喵大財團')";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":children_id", $childrenId);
  $createStmt->bindValue(":member_id", $memberId);
  $createStmt->bindValue(":sponsor_order_id", $sponsorOrderId);
  $createStmt->bindValue(":receive_date", $receiveDate);
  $createStmt->bindValue(":file_name", mkFilename($thanksLetterNo, $fileName));

  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  if (!copyFileToLocal($thanksLetterNo, $fileName)) {
    throw new Exception();
  }

  $updateSql = "update thanks_letter set thanks_letter_id = concat('TL',LPAD(LAST_INSERT_ID(), 3, 0)) where thanks_letter_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

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


function addFile($thanksLetterNo, $file, $fileNo )
{
  $dir = "../../images/thanksletter/";
  if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
  }
  $filename = mkFilename($thanksLetterNo, $file, $fileNo );
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  if (move_uploaded_file($from, $to)) {
    return $filename; // Return the newly added filename
  } else {
    throw new Exception("檔案新增失敗");
  }
}


function mkFilename($updateId, $file, $fileNo )
{
  $filename =  'TL' . str_pad($updateId, 3, "0", STR_PAD_LEFT) . '_' . $fileNo;
  $fileExt = pathInfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}

try {
    $addedFilename = addFile($thanksLetterNo, $fileName );
  } catch (Exception $e) {
    // 處理檔案新增失敗的情況
    echo $e->getMessage();
  }

