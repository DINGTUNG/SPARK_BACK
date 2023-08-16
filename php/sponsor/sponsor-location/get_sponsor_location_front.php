<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Origin: https://tibamef2e.com");//緯育
// header("Access-Control-Allow-Origin: http://localhost:5174");//本地端
require_once("../../connect_chd102g3.php");

try {
  $sql = "
  select * from sponsor_location 
  where del_flg = 0 and is_sponsor_location_online = 1";
  $sponsor_location = $pdo->query($sql);

  //----------------------------------------
  $sponsor_locationRow = $sponsor_location->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($sponsor_locationRow);
} catch (Exception $e) {
  echo "錯誤行號 : ", $e->getLine(), "<br>";
  echo "錯誤原因 : ", $e->getMessage(), "<br>";
  echo "系統暫時不能正常運行，請稍後再試<br>";
}
