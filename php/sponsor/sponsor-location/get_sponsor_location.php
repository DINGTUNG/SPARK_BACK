<?php
header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Origin: https://tibamef2e.com");//緯育
// header("Access-Control-Allow-Origin: http://localhost:5174");//本地端
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");
try {
  $sql = "select * from sponsor_location where del_flg = 0";
  $location = $pdo->prepare($sql);
  $location->execute();

  if ($location->rowCount() == 0) { //找不到
    //傳回空的JSON字串
    echo "{}";
  } else { //找得到
    //取回一筆資料
    $locationRow = $location->fetchAll(PDO::FETCH_ASSOC);
    //送出json字串
    echo json_encode($locationRow);
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
