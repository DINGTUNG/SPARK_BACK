<?php
session_start();
require_once("../../connect_chd102g3.php");
header("Access-Control-Allow-Origin: https://tibamef2e.com/chd102/g3/");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

try {
  if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];
    $get_memberInfo_sql = "SELECT * FROM member_info WHERE member_id = :member_id";
    $get_memberInfoStmt = $pdo->prepare($get_memberInfo_sql);
    $get_memberInfoStmt->bindValue(':member_id', $member_id);
    $get_memberInfoStmt->execute();

    $memberInfoRow = $get_memberInfoStmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($memberInfoRow[0]);
} 
} catch ( PDOException $e ) {
  echo $e->getMessage();
}

?>