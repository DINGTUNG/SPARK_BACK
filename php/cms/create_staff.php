<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com"); //緯育
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once("../connect_chd102g3.php");

try {

  $staffName = $_POST["staff_name"] ?? null;
  $staffPermission = $_POST["staff_permission"] ?? null;
  $staffEmail = $_POST["staff_email"] ?? null;
  $staffAccount = $_POST["staff_account"] ?? null;
  $staffPassword = $_POST["staff_password"] ?? null;

  // parameters validation
  if ($staffName == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供staff name)");
  }
  if ($staffPermission == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供staff permission)");
  }
  if ($staffEmail == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供staff email)");
  }
  if ($staffAccount == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供staff account)");
  }
  if ($staffPassword == null) {
    throw new InvalidArgumentException($message = "參數不足(請提供staff password)");
  }
  

  // create record
  $pdo->beginTransaction();


  $createSql = "insert into cms_staff(staff_name,staff_permission, staff_email, staff_account, staff_password, updater) values(:staff_name, :staff_permission, :staff_email, :staff_account, :staff_password, '董杯杯')";
  $createStmt = $pdo->prepare($createSql);
  $createStmt->bindValue(":staff_name", $staffName);
  $createStmt->bindValue(":staff_permission", $staffPermission);
  $createStmt->bindValue(":staff_email", $staffEmail);
  $createStmt->bindValue(":staff_account", $staffAccount);
  $createStmt->bindValue(":staff_password", $staffPassword);

  $createResult = $createStmt->execute();

  if (!$createResult) {
    throw new Exception();
  }
  $updateSql = "update cms_staff set staff_id = concat('CMS',LPAD(LAST_INSERT_ID(), 3, 0)) where staff_no = LAST_INSERT_ID()";
  $updateStmt = $pdo->prepare($updateSql);
  $updateResult = $updateStmt->execute();
  $pdo->commit();

  $selectSql = "select * from cms_staff where staff_no = (select LAST_INSERT_ID())";
  $selectStmt = $pdo->query($selectSql);
  $newMessage = $selectStmt->fetch(PDO::FETCH_ASSOC);
  http_response_code(200);
  echo json_encode($newMessage);
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
