<?php
header("Access-Control-Allow-Origin: http://localhost:5174");
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

    $verification_code = uniqid(); //產生驗證碼


    //設定SMTP
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com"; //SMTP服務器
    $mail->Port = 465; //SSL預設Port 是465, TLS預設Port 是587
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //使用SSL, 如果是TLS 請改為 PHPMailer::ENCRYPTION_STARTTLS
    $mail->Username = "spark.children.org@gmail.com"; // 這裡填寫你的SMTP登入帳號, 例如 your.gmail.name@gmail.com 則填寫your.gmail.name
    $mail->Password = "sykgftthshieczus"; //這裡填寫你的SMTP登入密碼. 即是應用程式密碼

    //設定郵件資訊
    $mail->From = "spark.children.org@gmail.com"; //設定寄件人電郵
    $mail->FromName = "=?UTF-8?B?" . base64_encode("星火兒童認養協會") . "?="; //設定寄件人名稱
    $mail->Subject = "=?UTF-8?B?" . base64_encode("星火兒童認養協會會員驗證信") . "?="; //設定郵件主題
    $mail->Body = "<p>感謝您的註冊！</p></br><p>要驗證您的帳號請複製: ".$verification_code." 至註冊頁面</p>";  //設定郵件內容
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
} catch ( PDOException $e ) {
    echo $e->getMessage();
  }


?>