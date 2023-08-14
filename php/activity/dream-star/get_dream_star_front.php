<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

 require_once("../../connect_chd102g3.php");

try{
  $sql = "select * from dream_star
  where del_flg = 0 and is_dream_star_online = 1 order by dream_star_no";
  $dream_star=$pdo->prepare($sql);
  $dream_star->execute();
  
  if( $dream_star->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
      echo"{}";
  }else{ //找得到
    //取回一筆資料
    $dream_star_row=$dream_star->fetchAll(PDO::FETCH_ASSOC);
    //送出json字串
    echo json_encode($dream_star_row);
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
