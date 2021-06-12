<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
    echo "ログインされていません<br>";
    echo "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    exit();
}else{
    echo $_SESSION['staff_name']."さんログイン中<br>";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフページ</title>
</head>
<body>
    <h2>ショップ管理トップメニュー</h2>
    <a href="../staff/staff_list.php">スタッフ管理ページ</a>
    <br>
    <a href="../product/product_list.php">商品管理ページ</a>
</body>
</html>