<?php
header("Access-Control-Allow-Origin: *");//標頭修改
 require_once("../../connect_chd102g3-yiiijie.php");
try{
  $sql = "select * from thanks_letter
  where del_flg = 0 order by thanks_letter_no";
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