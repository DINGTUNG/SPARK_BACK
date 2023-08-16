<?php

require_once("../../connect_chd102g3.php");

try {

  //執行sql指令並取得pdoStatement
  $sql = "select * from sponsor_order order by sponsor_order_no";
  $sponsor_order = $pdo->query($sql);

  //----------------------------------------
  //透過pdoStatement取回一筆一筆的資料
  $sponsor_orderRow = $sponsor_order->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($sponsor_orderRow);

} catch (Exception $e) {
  echo "錯誤行號 : ", $e->getLine(), "<br>";
  echo "錯誤原因 : ", $e->getMessage(), "<br>";
  echo "系統暫時不能正常運行，請稍後再試<br>";	
}