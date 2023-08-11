<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

 require_once("../../connect_chd102g3.php");
try{
  $sql = "select * from donate_project
  where del_flg = 0 order by donate_project_no";
  $donate_project=$pdo->prepare($sql);
  $donate_project->execute();
  
  if( $donate_project->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
      echo"{}";
  }else{ //找得到
    //取回一筆資料
    $donate_project_row=$donate_project->fetchAll(PDO::FETCH_ASSOC);
    //送出json字串
    echo json_encode($donate_project_row);
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>