<?php
// header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Origin: https://tibamef2e.com/");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/Exception.php';
require '../../../PHPMailer/PHPMailer.php';
require '../../../PHPMailer/SMTP.php';

try {


    $member_account = $_POST["member_account"];
    $verification_code = uniqid();


    //設定SMTP
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com"; //SMTP服務器

    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = 'tls'; // ssl is deprecated
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //使用SSL, 如果是TLS 請改為 PHPMailer::ENCRYPTION_STARTTLS
    $mail->Username = "spark.children.org@gmail.com"; // 這裡填寫你的SMTP登入帳號, 例如 your.gmail.name@gmail.com 則填寫your.gmail.name
    $mail->Password = "sykgftthshieczus"; //這裡填寫你的SMTP登入密碼. 即是應用程式密碼

    //設定郵件資訊
    $mail->From = "spark.children.org@gmail.com"; //設定寄件人電郵
    $mail->FromName = "=?UTF-8?B?" . base64_encode("星火兒童認養協會") . "?="; //設定寄件人名稱
    $mail->Subject = "=?UTF-8?B?" . base64_encode("星火兒童認養協會會員驗證信") . "?="; //設定郵件主題
    $mail->Body = "
    <div style = 'background-color:#1d3d6c; padding:30px 0;'>
    <div style = 'text-align:center; margin:20px 50px;padding:20px; color:#3d3a35; font-weight: bold; border-radius:15px; letter-spacing: 2px; background-color:#f5f4ef'>
        <p>親愛的&nbsp;".$member_account."<span><p>
        <br>
        <p >星火協會感謝您的註冊！我們誠摯的希望能與您共同守護貧困兒童的幸福未來</p>
        </br>
        <p>要驗證您的帳號請複製以下驗證碼: <span style =' color:#d8b06c; '>".$verification_code."</span> 至註冊頁面
        </p>
    </div>
    </div>
    "
    ;  //設定郵件內容
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