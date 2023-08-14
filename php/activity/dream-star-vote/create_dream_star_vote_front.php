<?php
header("Access-Control-Allow-Origin: *");
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

  // create record
  $pdo->beginTransaction();

  $createSql = "INSERT INTO dream_star_vote(vote_ip, dream_star_id,vote_time)
  VALUES(:vote_ip, :dream_star_id,now())";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":dream_star_id", $dreamStarId);
  $createStmt->bindValue(":vote_ip", $ip);
  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
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
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}



echo $ip;