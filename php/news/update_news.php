<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if ($_FILES["image"]["error"] === 0) {
  $dir = "../../images/news";
  if (file_exists($dir) === false) {
    mkdir($dir);
  }

  $from = $_FILES["news_image_first"]["name"];

  // 產生主檔名
  $fileName = uniqid();

  // 取出副檔名
  $fileExt = pathInfo($_FILES["news_image_first"]["name"], PATHINFO_EXTENSION); 

  $fileName = "$fileName.$fileExt"; //用uniqid()去串接副檔名

  $to = $dir . $fileName;
  if (copy($from, $to)) {
    //寫入資料庫
    try {
      require_once("../connect_chd102g3.php");

      $newsNo = $_POST["news_no"] ?? null;
      $newsDate = $_POST["news_date"] ?? null;
      $newsImageFirst = $_FILES["news_image_first"] ?? null;

      // parameters validation
      if ($newsNo == null) {
        throw new InvalidArgumentException($message = "參數不足(請提供news no)");
      }
      if ($newsDate == null) {
        throw new InvalidArgumentException($message = "參數不足(請提供news date)");
      }
      if ($newsImageFirst == null) {
        throw new InvalidArgumentException($message = "參數不足(請提供news image first)");
      }

      // check update record existed
      $checkRecordAliveSql = "select count(*) as count from news where news_no = :news_no and del_flg = 0";
      $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
      $checkRecordAliveStmt->bindValue(":news_no", $messageNo);
      $checkRecordAliveStmt->execute();
      $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
      $isNotExisted = $checkResult[0]['count'] == 0;

      if ($isNotExisted) {
        throw new UnexpectedValueException($message = "找不到刪除資料或資料已被刪除");
      }

      // update record
      $updateSql = "update news set news_date = :news_date,news_image_first = :news_image_first,updater='許咪咪', update_time = Now() where news_no = :news_no ";
      $updateStmt = $pdo->prepare($updateSql);
      $updateStmt->bindValue(":news_no", $newsNo);
      $updateStmt->bindValue(":news_date", $newsDate);
      $updateStmt->bindValue(":news_image_first", $newsImageFirst);
      $updateResult = $updateStmt->execute();
      http_response_code(200);
      echo json_encode($updateResult);
    } catch (InvalidArgumentException $e) {
      http_response_code(400);
      echo $e->getMessage();
    } catch (UnexpectedValueException $e) {
      http_response_code(412);
      echo $e->getMessage();
    } catch (Exception $e) {
      http_response_code(500);
      echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)";
    }
  }
}
