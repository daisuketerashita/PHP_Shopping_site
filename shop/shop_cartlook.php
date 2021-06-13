<?php
require_once('../env.php');
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	echo 'ようこそゲスト様　';
	echo '<a href="member_login.html">会員ログイン</a><br />';
	echo '<br />';
}
else
{
	echo 'ようこそ';
	echo $_SESSION['member_name'];
	echo '様　';
	echo '<a href="member_logout.php">ログアウト</a><br />';
	echo '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

try
{

$cart = $_SESSION['cart'];
$number = $_SESSION['number'];
$max = count($cart);

//データベース接続
$dbh = new PDO($dsn,$user,$pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

foreach($cart as $key => $val){
	$sql = "SELECT code,name,price,image FROM mst_product WHERE code=?";
	$stmt = $dbh->prepare($sql);
	$data[0] = $val;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

	$pro_name[] = $rec['name'];
	$pro_price[] = $rec['price'];
	if($rec['image'] == ''){
		$pro_image[] = '';
	}else{
		$pro_image[] = "<img src='../product/images/".$rec['image']."'>";
	}
}

$dbh = null;


}catch(Exception $e){
	echo'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<h3>カートの中身</h3>
<form action="number_change.php" method="post">
<?php for($i = 0;$i < $max;$i++): ?>
<p>
<?php echo $pro_name[$i]; ?>
<?php echo $pro_image[$i]; ?>
<?php echo $pro_price[$i]; ?>円
<input type="text" name="number<?php echo $i; ?>" value="<?php echo $number[$i]; ?>" style="width: 40px">
</p>
<p><?php echo $pro_price[$i] * $number[$i]; ?>円</p>
<hr>
<?php endfor; ?>
<input type="hidden" name="max" value="<?php echo $max; ?>">
<input type="submit" value="数量変更"><br>
<input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>