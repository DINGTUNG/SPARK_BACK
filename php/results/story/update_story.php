<?php
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");


try {
  $story_no = $_POST['story_no'];
  $story_title = $_POST['story_title'];
  $story_date = $_POST['story_date'];
  $story_brief = $_POST['story_brief'];
  $story_detail = $_POST['story_detail'];
  $story_detail_second = $_POST['story_detail_second'];
  $story_detail_third = $_POST['story_detail_third'];
 

  //得到原本的圖片名稱
  $sql_get_story_image = "SELECT story_image FROM story WHERE story_no = $story_no";
  $result_get_story_image = $pdo->query($sql_get_story_image);
  if ($row = $result_get_story_image->fetch(PDO::FETCH_ASSOC)) {
    $story_image = $row['story_image'];
  }

  //得到 story_id
  $sql_get_story_id = "SELECT story_id FROM story WHERE story_no = $story_no";
  $result_get_story_id = $pdo->query($sql_get_story_id);
  if ($row = $result_get_story_id->fetch(PDO::FETCH_ASSOC)) {
    $story_id = $row['story_id'];
  }

  //上傳圖片
  if ($_FILES['story_image']) {
    $targetDir = '../../../images/story/';
    $storyNo = $story_id;

    // 得到上傳檔案的副檔名。
    $originalFileName = $_FILES['story_image']['name'];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

    // 創建新名稱。
    $newFileName = "story_" . $storyNo . "." . $fileExtension;
    $targetPath = $targetDir . $newFileName;

    // 檢查目標目錄是否存在，不存在則創建它。
    if (!file_exists($targetDir)) {
      mkdir($targetDir, 0777, true);
    }
    $from = $_FILES['story_image']['tmp_name'];
    $to = $targetPath;
    copy($from, $to);
  } else {
     $newFileName =  $story_image;
  }

  $sql = "UPDATE story SET story_title = :story_title, story_date = :story_date, story_image = :newFileName, story_brief = :story_brief, story_detail = :story_detail, story_detail_second = :story_detail_second, story_detail_third = :story_detail_third WHERE story_no = :story_no";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':story_no', $story_no);
  $statement->bindValue(':story_title', $story_title);
  $statement->bindValue(':story_date', $story_date);
  $statement->bindValue(':newFileName', $newFileName);
  $statement->bindValue(':story_brief', $story_brief);
  $statement->bindValue(':story_detail', $story_detail);
  $statement->bindValue(':story_detail_second', $story_detail_second);
  $statement->bindValue(':story_detail_third', $story_detail_third);
  $result = $statement->execute();
  if ($result) {
    $json = array(
      "ok" => true,
      "massage" => "編輯成功"
    );
    $response = json_encode($json);

  } else {
    $json = array(
      "ok" => false,
      "massage" => "編輯失敗"
    );
    $response = json_encode($json);
  }
  header("Location: https://tibamef2e.com/chd102/g3/back-end/story");
} catch (PDOException $e) {
  echo "錯誤行號 : ", $e->getLine(), "<br>";
  echo "錯誤原因 : ", $e->getMessage(), "<br>";
  echo "系統暫時不能正常運行，請稍後再試<br>";
  error_log($e->getMessage());
};
