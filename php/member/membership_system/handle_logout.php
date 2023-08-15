<?php
header("Access-Control-Allow-Origin: http://localhost:5174");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
session_start();
try {
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
        session_destroy();
        $session_data = array(
          'status' => 'ok',
      );
        $res = json_encode($session_data);
        echo $res;
    } else {
        $session_data = array(
          'status' => 'error',
      );
        $res = json_encode($session_data);
        echo $res;
    }

  } catch ( PDOException $e ) {
    echo $e->getMessage();
  }
  
?>