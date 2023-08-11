<?php
header("Access-Control-Allow-Origin: *"); //標頭修改
require_once("../connect_chd102g3.php");
try {
  $sql = "select * from news where del_flg = 0";
  $news = $pdo->query($sql);

  if ($news->rowCount() == 0) { //找不到
    //傳回空的JSON字串
    echo "{}";
  } else { //找得到
    //取回一筆資料
    $newsRow = $news->fetchAll(PDO::FETCH_ASSOC);
    //送出json字串
    echo json_encode($newsRow);
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
