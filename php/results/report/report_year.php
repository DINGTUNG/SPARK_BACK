<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

 require_once("../../connect_chd102g3.php");
try{
  $sql = "SELECT * FROM report WHERE report_class = '年度' AND del_flg = 0 AND is_report_online = 0;
  ";
  $location=$pdo->prepare($sql);
  $location->execute();
  if( $location->rowCount() == 0 ){ 
      echo"{}";
  }else{
    $localRow=$location->fetchAll(PDO::FETCH_ASSOC);
   
    echo json_encode($localRow);
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>