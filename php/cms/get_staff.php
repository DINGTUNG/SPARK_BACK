<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

 require_once("../connect_chd102g3.php");

try{
  $sql = "select * from cms_staff
  where del_flg = 0 order by staff_no";
  $cms_staff = $pdo->prepare($sql);
  $cms_staff->execute();
  
  if( $cms_staff->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
      echo"{}";
  }else{ //找得到
    //取回一筆資料
    $cms_staff_row = $cms_staff->fetchAll(PDO::FETCH_ASSOC);
    //送出json字串
    echo json_encode($cms_staff_row);
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>