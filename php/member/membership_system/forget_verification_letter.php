<?php
require_once("../../connect_chd102g3.php");
header("Access-Control-Allow-Origin: https://tibamef2e.com/chd102/g3/");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/Exception.php';
require '../../../PHPMailer/PHPMailer.php';
require '../../../PHPMailer/SMTP.php';

try {
        $member_account = $_GET['member_account'];

        $match_sql = "SELECT * FROM member_info WHERE member_account = :member_account ";
        $matchStmt = $pdo->prepare($match_sql);
        $matchStmt->bindValue(':member_account', $member_account);
        $matchStmt->execute();
        
        if ( $matchStmt->rowCount() < 1 ) {
            $json = array(
                "status" => "error",
                "msg" => "查無此帳號",
            );
            echo json_encode($json);
        } else {
                $verification_code = uniqid(); //產生驗證碼
        
                //設定SMTP
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = "mail.tibamef2e.com"; //SMTP服務器
                $mail->Port = 465; //SSL預設Port 是465, TLS預設Port 是587
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Username = "_mainaccount@tibamef2e.com"; // 這裡填寫你的SMTP登入帳號, 例如 your.gmail.name@gmail.com 則填寫your.gmail.name
                $mail->Password = "8Dz#IEdu9]52jW"; //這裡填寫你的SMTP登入密碼. 即是應用程式密碼
            
                //設定郵件資訊
                $mail->From = "spark.children.org@gmail.com"; //設定寄件人電郵
                $mail->FromName = "=?UTF-8?B?" . base64_encode("星火兒童認養協會") . "?="; //設定寄件人名稱
                $mail->Subject = "=?UTF-8?B?" . base64_encode("【星火兒童認養協會】忘記密碼驗證信") . "?="; //設定郵件主題
                $mail->Body = "<p>要修改您的密碼請複製: ".$verification_code." 至忘記密碼頁面</p>";  //設定郵件內容
                $mail->IsHTML(true);  //設定是否使用HTML格式
                $mail->addAddress($member_account); //設定收件人電郵及名稱
            
                if(!$mail->Send()){
                    $json = array(
                        "status" => "error",
                        "msg" => "驗證信寄送失敗"  . $mail->ErrorInfo,
                    );
                    echo json_encode($json);
                }
                else{
                    setcookie("verification_code", $verification_code, time()+3600, "/");
                    $json = array(
                        "status" => "ok",
                    );
                    echo json_encode($json);
                }
            }

} catch ( PDOException $e ) {
    echo $e->getMessage();
  }


?>