<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Origin: https://tibamef2e.com");//緯育
// header("Access-Control-Allow-Origin: http://localhost:5174");//本地端
require_once("../connect_chd102g3.php");
try {
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

  // create record
  $createSql = "INSERT INTO news
  (news_title,
  news_date,
  news_content_first,
  news_image_first,
  updater,
  update_time) 
  VALUES
  (:news_title,
    :news_date,
    :news_content_first,
    :news_image_first,
    'sir',
    Now())";

  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":news_title", $newsTitle);
  $createStmt->bindValue(":news_date", $newsDate);
  $createStmt->bindValue(":news_content_first", $newsContentFirst);
  $createStmt->bindValue(":news_image_first", mkFilename('temp', $newsImageFirst, 1));
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $lastInsertId = $pdo->lastInsertId();
  
  $updateSql ="UPDATE
  news
SET
  news_id = CONCAT('N', LPAD(:last_insert_id, 3, 0)),
  news_content_first = :news_content_first,
  news_image_first =:news_image_first,
  news_content_second = :news_content_second,
  news_image_second =:news_image_second,
  news_content_third =:news_content_third,
  news_image_third =:news_image_third,
  news_content_fourth =:news_content_fourth,
  news_image_fourth =:news_image_fourth,
  updater = 'sir',
  update_time = Now()
WHERE
  news_no = :last_insert_id";
  $updateStmt = $pdo->prepare($updateSql);
  $updateStmt->bindValue(":last_insert_id", $lastInsertId);
  $updateStmt->bindValue(":news_content_first", $newsContentFirst);
  $updateStmt->bindValue(":news_image_first", mkFilename($lastInsertId, $newsImageFirst, 1));
  $updateStmt->bindValue(":news_content_second", $newsContentSecond);
  $updateStmt->bindValue(":news_image_second", mkFilename($lastInsertId, $newsImageSecond, 2));
  $updateStmt->bindValue(":news_content_third", $newsContentThird);
  $updateStmt->bindValue(":news_image_third", mkFilename($lastInsertId, $newsImageThird, 3));
  $updateStmt->bindValue(":news_content_fourth", $newsContentFourth);
  $updateStmt->bindValue(":news_image_fourth", mkFilename($lastInsertId, $newsImageFourth, 4));
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  if (!$updateResult) {
    throw new Exception();
  }
  if (!copyFileToLocal($lastInsertId, $newsImageFirst, 1)) {
    throw new Exception();
  }
  if (!copyFileToLocal($lastInsertId, $newsImageSecond, 2)) {
    throw new Exception();
  }
  if (!copyFileToLocal($lastInsertId, $newsImageThird, 3)) {
    throw new Exception();
  }
  if (!copyFileToLocal($lastInsertId, $newsImageFourth, 4)) {
    throw new Exception();
  }

  $selectSql = "select * from news where news_no = (select LAST_INSERT_ID())";
  $selectStmt = $pdo->query($selectSql);
  $newNews = $selectStmt->fetch(PDO::FETCH_ASSOC);
  http_response_code(200);
  echo json_encode($newNews);
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
  echo $e;
  $pdo->rollBack();
}

function copyFileToLocal($lastInsertId, $file, $fileNo)
{
  $dir = "../../images/news/";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $filename = mkFilename($lastInsertId, $file, $fileNo);
  $from = $file["tmp_name"];
  $to = $dir . $filename;
  return copy($from, $to);
}

function mkFilename($lastInsertId, $file, $fileNo)
{
  $filename =  'N' . str_pad($lastInsertId, 3, "0", STR_PAD_LEFT) . '_' . $fileNo;
  $fileExt = pathInfo($file["name"], PATHINFO_EXTENSION);
  $filename = "$filename.$fileExt";
  return $filename;
}
