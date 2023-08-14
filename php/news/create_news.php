<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
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

  // update record
  $createSql = "insert into news
  (news_title,
  news_date,
  news_content_first,
  news_image_first,
  news_content_second,
  news_image_second,
  news_content_third,
  news_image_third,
  news_content_fourth,
  news_image_fourth,
  updater,
  update_time,
  news_no) 
  values
  (:news_title,
    :news_date,
    :news_content_first,
    :news_image_first,
    :news_content_second,
    :news_image_second,
    :news_content_third,
    :news_image_third,
    :news_content_fourth,
    :news_image_fourth,
    'sir',
    Now(),
    :news_no )";

  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":news_no",$newsNo);
  $createStmt->bindValue(":news_title",$newsTitle);
  $createStmt->bindValue(":news_date", $newsDate);
  $createStmt->bindValue(":news_content_first", $newsContentFirst);
  $createStmt->bindValue(":news_image_first", mkFilename($newsNo, $newsImageFirst, 1));
  $createStmt->bindValue(":news_content_second", $newsContentSecond);
  $createStmt->bindValue(":news_image_second", mkFilename($newsNo, $newsImageSecond, 2));
  $createStmt->bindValue(":news_content_third", $newsContentThird);
  $createStmt->bindValue(":news_image_third", mkFilename($newsNo, $newsImageThird, 3));
  $createStmt->bindValue(":news_content_fourth", $newsContentFourth);
  $createStmt->bindValue(":news_image_fourth", mkFilename($newsNo, $newsImageFourth, 4));
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  if (!copyFileToLocal($newsNo, $newsImageFirst, 1)) {
    throw new Exception();
  }
  if (!copyFileToLocal($newsNo, $newsImageSecond, 2)) {
    throw new Exception();
  }
  if (!copyFileToLocal($newsNo, $newsImageThird, 3)) {
    throw new Exception();
  }
  if (!copyFileToLocal($newsNo, $newsImageFourth, 4)) {
    throw new Exception();
  }

  $updateSql = "update news set news_id = concat('N',LPAD(LAST_INSERT_ID(), 3, 0)) where news_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from news where news_no = (select LAST_INSERT_ID())";
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

function copyFileToLocal($newsNo, $file, $fileNo)
{
  $dir = "../../images/news/origin";
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
?>

