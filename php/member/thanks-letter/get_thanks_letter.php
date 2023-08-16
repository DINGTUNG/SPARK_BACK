<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

//  require_once("../../connect_chd102g3-yiiijie.php");
 require_once("../../connect_chd102g3.php");
try{
  $sql = "select * from thanks_letter
  where del_flg = 0 order by thanks_letter_no";
  $thanksLetter = $pdo->query($sql);
  
  if( $thanksLetter->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
      echo"{}";
  }else{ //找得到
    //取回一筆資料
    $thanksLetterRow = $thanksLetter->fetchAll(PDO::FETCH_ASSOC);
    //送出json字串
    echo json_encode($thanksLetterRow);
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>