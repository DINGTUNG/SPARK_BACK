<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    $conn = new mysqli(
        'localhost',
        'root',
        'kayla1221',
        'tibamefe_chd102g3');
    if( $conn->connect_error ){
        die('資料庫連接錯誤<br/>');
    }

    $conn->query('set names utf8');
    $conn->query('set time_zone = "+8:00"');

?>