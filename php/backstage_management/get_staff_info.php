<?php
session_start();
require_once("../connect_chd102g3.php");
header("Access-Control-Allow-Origin: https://tibamef2e.com");
// header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

try {
  if (isset($_SESSION['staff_no'])) {
    $staff_no = $_SESSION['staff_no'];
    $get_staffInfo_sql = "SELECT * FROM cms_staff WHERE staff_no = :staff_no";
    $get_staffInfoStmt = $pdo->prepare($get_staffInfo_sql);
    $get_staffInfoStmt->bindValue(':staff_no', $staff_no);
    $get_staffInfoStmt->execute();

    $staffInfoRow = $get_staffInfoStmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($staffInfoRow[0]);
} 
} catch ( PDOException $e ) {
  echo $e->getMessage();
}

?>