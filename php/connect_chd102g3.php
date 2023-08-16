<?php 
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: https://tibamef2e.com");//緯育
// header("Access-Control-Allow-Origin: http://localhost:5173");//本地端
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    // $dbname = "tibamefe_chd102g3";
    // $user = "spark";
    // $password = "666";
    // $port = 3306;

    //緯育
    $dbname = "tibamefe_chd102g3"; //資料庫名稱
    $user = "tibamefe_since2021"; //帳號
    $password = "vwRBSb.j&K#E"; //密碼
    $port = 3306;

    //詢問資料庫建置位置
    $dsn = "mysql:host=localhost;port=$port;dbname=$dbname;charset=utf8";

    $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);

    try {
      $pdo = new PDO($dsn, $user, $password, $options);
      $dbh = null;
    } catch (PDOException $e) {
      die("Error!: " . $e->getMessage() . "<br/>");
    }
