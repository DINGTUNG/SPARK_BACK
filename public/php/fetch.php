<?php 
//在這裡取得資料的門票
try {
	require_once("../connectBooks.php");

	//執行sql指令並取得pdoStatement
	$sql = "select * from products"; //準備好我們要的sql指令
	$products = $pdo->query($sql);//透過pdo物件送到mysql去執行, 並傳回pdoStatement物件

} catch (PDOException $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
<style>
	.products td {
		border-bottom: 1px dotted deeppink;
	}
</style>
</head>

<body>
<table class='products' align='center' width='800'>	
<tr bgcolor='#bfbfef'><th>書號</th><th>書名</th><th>價格</th><th>作者</th></tr>	
<?php 
//在這裡顯示資料
while($prodRow = $products->fetch(PDO::FETCH_ASSOC)){
?>
			<tr>
			<td><?=$prodRow["psn"]?></td>
			<td><?=$prodRow["pname"]?></td>
			<td><?=$prodRow["price"]?></td>
			<td><?=$prodRow["author"]?></td>
			</tr>
<?php	
}
?>
</table>
共有資料列<?php echo $products->rowCount();?>筆
</body>
</html>