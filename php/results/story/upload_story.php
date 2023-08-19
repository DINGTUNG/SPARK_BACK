<?php
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");
try {
  $story_no = $_POST['story_no'];
  $is_story_online = $_POST['is_story_online'];
  if ($is_story_online == 1) {
    $status_code = 0;
  } else {
    $status_code = 1;
  }

  $online_count = "SELECT COUNT(*) FROM story WHERE is_story_online = 1 AND del_flg = 0";
  $online_count_result = $pdo->query($online_count);
  $online_count_row = $online_count_result->fetch(PDO::FETCH_ASSOC);
  if ($online_count_row['COUNT(is_story_online)'] >= 18 && $status_code == 1) {
    exit();
  }
  $sql = "UPDATE story SET is_story_online = :status_code  WHERE story_no = :story_no";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':status_code', $status_code);
  $stmt->bindValue(':story_no', $story_no);
  $stmt->execute();
  
  if( $stmt->execute()) {
    $json = array(
      "ok" => true,
      "message" => "修改成功"
    );
    echo json_encode($json);
  } else {
    $json = array(
      "ok" => false,
      "message" => "修改失敗" . $stmt->errorInfo()
    );
    echo json_encode($json);
  }
} catch (PDOException $e) {
  echo "錯誤行號 : ", $e->getLine(), "<br>";
  echo "錯誤原因 : ", $e->getMessage(), "<br>";
  echo "系統暫時不能正常運行，請稍後再試<br>";
  error_log($e->getMessage());
}
