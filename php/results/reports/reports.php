<?php
header("Access-Control-Allow-Origin: *");
 require_once("../../connect_chd102g3.php");
try{
  $sql = "select * from reports";
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