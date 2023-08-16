<?php
require_once("../../connect_chd102g3.php");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin: https://tibamef2e.com/chd102/g3/");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

try {
    if(isset($_COOKIE["member_no"])) {
        $member_no = $_COOKIE["member_no"];
    } else {
        $error = array(
            'status' => 'error',
            'msg' => '前一步的驗證已到期，請重新註冊'
        );
        $res = json_encode($error);
        echo $res;
    }
    $member_name = $_POST['member_name'];
    $member_salutation = $_POST['member_salutation'];
    $member_mobile = $_POST['member_mobile'];
    $member_home_phone = $_POST['member_home_phone'];
    $member_business_phone = $_POST['member_business_phone'];
    $member_address = $_POST['member_address'];
    $receipt_class = $_POST['receipt_class'];
    $member_id_card = $_POST['member_id_card'];
    $member_birthyear = $_POST['member_birthyear'];
    $member_birthmonth = $_POST['member_birthmonth'];
    $member_birthday = $_POST['member_birthday'];

    if (empty($member_name) || empty($member_salutation) || empty($member_mobile) || empty($member_address) || empty($receipt_class) || empty($member_id_card) || empty($member_birthyear) || empty($member_birthmonth) || empty($member_birthday)) {
        $error = array(
            'status' => 'error',
            'msg' => '請完整輸入資料'
        );
        $res = json_encode($error);
        echo $res;

    } else {

        $get_member_id = "SELECT `member_id` FROM `member_info` WHERE `member_no` = $member_no";
        $get_member_id_stmt = $pdo->prepare($get_member_id);
        $get_member_id_stmt->execute();
        $get_member_id_row = $get_member_id_stmt->fetch(PDO::FETCH_ASSOC);
        $member_id = $get_member_id_row['member_id'];



        //頭像上傳
        if($_FILES['member_img']){
            $targetDir = '../../../images/member-info/';
            // 得到上傳檔案的副檔名。
            $originalFileName = $_FILES['member_img']['name'];
            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        
            // 創建新名稱。
            $newFileName = "photo_stickers_" . $member_id . "." . $fileExtension;
            $targetPath = $targetDir . $newFileName;
            move_uploaded_file($_FILES['member_img']['tmp_name'], $targetPath);
            
        }

        //會員註冊 第二步
        $sql_register = "UPDATE `member_info` SET `member_name` = :member_name, `member_salutation` = :member_salutation, `member_mobile` = :member_mobile, `member_home_phone` = :member_home_phone, `member_business_phone` = :member_business_phone, `member_address` = :member_address, `receipt_class` = :receipt_class, `member_id_card` = :member_id_card, `member_img` = :member_img , `member_birthyear` = :member_birthyear, `member_birthmonth` = :member_birthmonth, `member_birthday` = :member_birthday  WHERE `member_no` = $member_no";

        $registerStmt = $pdo->prepare($sql_register);
        $registerStmt->bindValue(':member_name', $member_name);
        $registerStmt->bindValue(':member_salutation', $member_salutation);
        $registerStmt->bindValue(':member_mobile', $member_mobile);
        $registerStmt->bindValue(':member_home_phone', $member_home_phone);
        $registerStmt->bindValue(':member_business_phone', $member_business_phone);
        $registerStmt->bindValue(':member_address', $member_address);
        $registerStmt->bindValue(':receipt_class', $receipt_class);
        $registerStmt->bindValue(':member_id_card', $member_id_card);
        $registerStmt->bindValue(':member_img', $newFileName);
        $registerStmt->bindValue(':member_birthyear', $member_birthyear);
        $registerStmt->bindValue(':member_birthmonth', $member_birthmonth);
        $registerStmt->bindValue(':member_birthday', $member_birthday);

        $registerStmt->execute();

        if ( $registerStmt->rowCount() > 0) {
            $json = array(
                'status' => 'ok',
                'msg' => '資料寫入成功'
            );
            setcookie("member_no", "" , time() - 3600, "/");
            $res = json_encode($json);
            echo $res;
        } else {
            $json = array(
                'status' => 'error',
                'position' => '3',
                'msg' => '資料寫入失敗'
            );
            $res = json_encode($json);
            echo $res;
        }
    }

} catch ( PDOException $e ) {
    echo $e->getMessage();
  }


?>