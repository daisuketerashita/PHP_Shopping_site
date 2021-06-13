<?php
require_once('../env.php');
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login']) === false){
    echo "ようこそゲスト様";
    echo "<a href='member_login.html'>会員ログイン</a>";
    echo "<br>";
}else{
    echo "ようこそ！";
    echo $_SESSION['member_name']."様";
    echo "<a href='member_logout.php'>ログアウト</a>";
    echo "<br>";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧ページ</title>
</head>
<body>
    <?php
    try{
        //データベース接続
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //SQLの実行
        $sql = "SELECT code,name,price FROM mst_product WHERE 1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        //データベースから切断
        $dbh = null;

        echo "<h2>商品一覧</h2>";

        while(true){
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false){
                break;
            }
            echo "<a href='shop_product.php?procode=".$rec['code']."'>";
            echo $rec['name']."---";
            echo $rec['price'].'円';
            echo "</a>";
            echo "<br>";
        }
        
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>
</body>
</html>