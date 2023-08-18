<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin: https://tibamef2e.com");//緯育
// header("Access-Control-Allow-Origin: http://localhost:5174");//本地端
require_once("../../connect_chd102g3.php");
try {
  $sql = "
  select * from milestone 
  where del_flg = 0 order by milestone_no"; 
  $milestone = $pdo->query($sql);

  if ($milestone->rowCount() == 0) { //找不到
    //傳回空的JSON字串
    echo "{}";
  } else { //找得到
    //取回一筆資料
    $milestoneRow = $milestone->fetchAll(PDO::FETCH_ASSOC);
    //送出json字串
    echo json_encode($milestoneRow);
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
