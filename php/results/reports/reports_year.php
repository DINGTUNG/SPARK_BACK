<?php
header("Access-Control-Allow-Origin: *");
 require_once("../../connect_chd102g3.php");
try{
  $sql = "SELECT * FROM reports WHERE report_class = '年度' AND del_flg = 0;
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