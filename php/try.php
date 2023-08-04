<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
try {
  $dbname = "tibamefe_chd102g3";
  $user = "spark";
  $password = "666";
  $port = 3306;

	$dsn = "mysql:host=localhost;port=$port;dbname=$dbname;charset=utf8";

	$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);

	//建立pdo物件
	$pdo = new PDO($dsn, $user, $password, $options);

	//執行sql指令並取得pdoStatement
  $sql = "select * from cms_staff";
	$cms_staff = $pdo->query($sql);


	//準備輸出到表格中
	echo "<table class='products' align='center' width='800'>";
	echo "<tr bgcolor='#bfbfef'><th>書號</th><th>書名</th><th>價格</th><th>作者</th></tr>";
	//----------------------------------------
	//透過pdoStatement取回一筆一筆的資料
	while($cms_staffRow = $cms_staff->fetch(PDO::FETCH_ASSOC)){
		echo "<tr>";
		echo "<td>{$cms_staffRow["staff_name"]}</td>";
		// echo "<td>{$cms_staffRow["pname"]}</td>";
		// echo "<td>{$cms_staffRow["price"]}</td>";
		// echo "<td>{$cms_staffRow["author"]}</td>";
		echo "</tr>";		
	}

	//----------------------------------------
	echo "</table>";
	//echo "======總列數 : ", ?????? , "<br>";
} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>
