<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

$story_no = $_GET['story_no'];

try {
  $sql = "SELECT * FROM story WHERE story_no=" . $story_no;
  $result = $pdo->query($sql);
  $res = json_encode($result->fetchAll(PDO::FETCH_ASSOC));
  echo $res;
} catch (\Throwable $th) {
  echo "錯誤行號 : ", $e->getLine(), "<br>";
  echo "錯誤原因 : ", $e->getMessage(), "<br>";
  echo "系統暫時不能正常運行，請稍後再試<br>";
}
