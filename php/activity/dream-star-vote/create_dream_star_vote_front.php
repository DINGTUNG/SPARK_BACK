<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../../connect_chd102g3.php");

try {
  $dreamStarId = $_POST["dream_star_id"] ?? null;
  $ip = get_ip();
  // parameters validation
  if ($dreamStarId == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供dream_star_id)");
  }

  $pdo->beginTransaction();
  // check duplicate ip
  $checkRecordAliveSql = "select count(*) as count from dream_star_vote where vote_ip = :vote_ip";
  $checkRecordAliveStmt = $pdo->prepare($checkRecordAliveSql);
  $checkRecordAliveStmt->bindValue(":vote_ip", $ip);
  $checkRecordAliveStmt->execute();
  $checkResult = $checkRecordAliveStmt->fetchAll(PDO::FETCH_ASSOC);
  $isExisted = $checkResult[0]['count'] != 0;

  if ($isExisted) {
    throw new UnexpectedValueException($message = "您今天已經投過票囉!");
  }

  // create record
  $createSql = "INSERT INTO dream_star_vote(vote_ip, dream_star_id,vote_time)
  VALUES(:vote_ip, :dream_star_id,now())";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":dream_star_id", $dreamStarId);
  $createStmt->bindValue(":vote_ip", $ip);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }

  $pdo->commit();
  http_response_code(200);
} catch (InvalidArgumentException $e) {
  http_response_code(400);
  echo $e->getMessage();
  $pdo->rollBack();
} catch (UnexpectedValueException $e) {
  http_response_code(412);
  echo $e->getMessage();
  $pdo->rollBack();
} catch (Exception $e) {
  http_response_code(500);
  echo $e;
  $pdo->rollBack();
}


function get_ip()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
  {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
  {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

echo $ip;
