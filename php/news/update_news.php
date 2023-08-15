<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require_once("../connect_chd102g3.php");
try {

  $newsNo = $_POST["news_no"] ?? null;
  $newsTitle = $_POST["news_title"] ?? null;
  $newsDate = $_POST["news_date"] ?? null;
  $newsContentFirst = $_POST["news_content_first"] ?? null;
  $newsImageFirst = $_FILES["news_image_first"] ?? null;
  $newsContentSecond = $_POST["news_content_second"] ?? null;
  $newsImageSecond = $_FILES["news_image_second"] ?? null;
  $newsContentThird = $_POST["news_content_third"] ?? null;
  $newsImageThird = $_FILES["news_image_third"] ?? null;
  $newsContentFourth = $_POST["news_content_fourth"] ?? null;
  $newsImageFourth = $_FILES["news_image_fourth"] ?? null;

  // parameters validation
  if ($newsNo == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news no)");
  }
  if ($newsTitle == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news title)");
  }
  if ($newsDate == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news date)");
  }
  if ($newsContentFirst == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news content first)");
  }
  if ($newsImageFirst == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news image first)");
  }
  if ($newsContentSecond == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news content second)");
  }
  if ($newsImageSecond == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news image second)");
  }
  if ($newsContentThird == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news content third)");
  }
  if ($newsImageThird == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news image third)");
  }
  if ($newsContentFourth == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news content fourth)");
  }
  if ($newsImageFourth == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供news image fourth)");
  }

  $pdo->beginTransaction();

  // check update record existed
  $checkRecordAliveSql = "select count(*) as count from news where news_no = :news_no and del_flg = 0";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":news_no", $newsNo);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isNotExisted = $checkResult[0]['count'] == 0;

  if ($isNotExisted) {
    throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
  }

  // update record
  $updateSql = "update news set
  news_title = :news_title, 
  news_date = :news_date,
  news_content_first = :news_content_first,
  news_image_first = :news_image_first,
  news_content_second = :news_content_second,
  news_image_second = :news_image_second,
  news_content_third = :news_content_third,
  news_image_third = :news_image_third,
  news_content_fourth = :news_content_fourth,
  news_image_fourth = :news_image_fourth,
  updater='sir', 
  update_time = Now()
  where news_no = :news_no ";

  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":news_no", $newsNo);
  $updateStmt->bindValue(":news_title",$newsTitle);
  $updateStmt->bindValue(":news_date", $newsDate);
  $updateStmt->bindValue(":news_content_first", $newsContentFirst);
  $updateStmt->bindValue(":news_image_first", mkFilename($newsNo, $newsImageFirst, 1));
  $updateStmt->bindValue(":news_content_second", $newsContentSecond);
  $updateStmt->bindValue(":news_image_second", mkFilename($newsNo, $newsImageSecond, 2));
  $updateStmt->bindValue(":news_content_third", $newsContentThird);
  $updateStmt->bindValue(":news_image_third", mkFilename($newsNo, $newsImageThird, 3));
  $updateStmt->bindValue(":news_content_fourth", $newsContentFourth);
  $updateStmt->bindValue(":news_image_fourth", mkFilename($newsNo, $newsImageFourth, 4));
  $updateResult = $updateStmt->execute();


  if (!$updateResult) {
    throw new UnexpectedValueException($message = "更新資料庫失敗(請聯絡管理人員)");
  }
  if (!copyFileToLocal($newsNo, $newsImageFirst, 1)) {
    throw new UnexpectedValueException($message = "檔案1儲存失敗(copy failed)");
  }
  if (!copyFileToLocal($newsNo, $newsImageSecond, 2)) {
    throw new UnexpectedValueException($message = "檔案2儲存失敗(copy failed)");
  }
  if (!copyFileToLocal($newsNo, $newsImageThird, 3)) {
    throw new UnexpectedValueException($message = "檔案3儲存失敗(copy failed)");
  }
  if (!copyFileToLocal($newsNo, $newsImageFourth, 4)) {
    throw new UnexpectedValueException($message = "檔案4儲存失敗(copy failed)");
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

function copyFileToLocal($newsNo, $file, $fileNo)
{
  $dir = "../../images/news/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($newsNo, $file, $fileNo);
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename($updateId, $file, $fileNo)
{
  $filename =  'N' . str_pad($updateId, 3, "0", STR_PAD_LEFT) . '_' . $fileNo;
  $fileExt = pathInfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}





