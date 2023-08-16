<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {

  //執行sql指令並取得pdoStatement
  $sql = "select * from dream_star_vote order by vote_time";
  $dream_star_vote = $pdo->query($sql);

  //----------------------------------------
  //透過pdoStatement取回一筆一筆的資料
  $dream_star_voteRow = $dream_star_vote->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($dream_star_voteRow);

} catch (Exception $e) {
  echo "錯誤行號 : ", $e->getLine(), "<br>";
  echo "錯誤原因 : ", $e->getMessage(), "<br>";
  echo "系統暫時不能正常運行，請稍後再試<br>";	
}