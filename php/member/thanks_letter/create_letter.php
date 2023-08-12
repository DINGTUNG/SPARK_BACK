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
  $thanksletterImg = $_POST["thanksletter_img"] ?? null;
  

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
  if ($thanksletterImg == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供感謝函圖檔)");
  }


  // create record
  $pdo->beginTransaction();


  $createSql = "insert into thanks_letter(children_id, member_id, sponsor_order_id, receive_date, thanksletter_img, register, updater) values(:children_id, :member_id, :sponsor_order_id, :receive_date, :thanksletter_img, '星火阿菜', '星火喵喵大財團')";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":children_id", $childrenId);
  $createStmt->bindValue(":member_id", $memberId);
  $createStmt->bindValue(":sponsor_order_id", $sponsorOrderId);
  $createStmt->bindValue(":receive_date", $receiveDate);
  $createStmt->bindValue(":thanksletter_img", $thanksletterImg);

  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $updateSql = "update thanks_letter set thanks_letter_id = concat('TL',LPAD(LAST_INSERT_ID(), 3, 0)) where thanks_letter_id = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from thanks_letter where thanks_letter_id = (select LAST_INSERT_ID())";
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
  echo $e;
  $pdo->rollBack();
}

function copyFileToLocal( $thanksLetterId ,$file, $fileNo )
{
  $dir = "../../images/thanksletter/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename(  $thanksLetterId, $file, $fileNo  );
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename( $file )
{
  $filename = $file;
  $fileExt = pathInfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}

