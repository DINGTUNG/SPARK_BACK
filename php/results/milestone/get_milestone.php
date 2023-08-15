<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $sql = "
  select * from milestone 
  where del_flg = 0 order by milestone_no";
  $milestone = $pdo->query($sql);

  //----------------------------------------
  $milestoneRow = $milestone->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($milestoneRow);
} catch (Exception $e) {
  echo "錯誤行號 : ", $e->getLine(), "<br>";
  echo "錯誤原因 : ", $e->getMessage(), "<br>";
  echo "系統暫時不能正常運行，請稍後再試<br>";
}
