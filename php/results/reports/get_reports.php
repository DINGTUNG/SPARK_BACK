<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
 require_once("../../connect_chd102g3.php");
try{
  $sql = "select * from reports where del_flg = 0";
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