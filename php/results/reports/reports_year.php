<?php
header("Access-Control-Allow-Origin: *");//標頭修改
 require_once("../../connect_chd102g3.php");
try{
  $sql = "select * from reports where report_class ='年度'";
  $location=$pdo->prepare($sql);
  $location->execute();
  
  if( $location->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
      echo"{}";
  }else{ //找得到
    //取回一筆資料
    $localRow=$location->fetchAll(PDO::FETCH_ASSOC);
    //送出json字串
    echo json_encode($localRow);
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>