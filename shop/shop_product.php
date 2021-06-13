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
    <title>商品参照画面</title>
</head>
<body>
    <?php
    try{
        $pro_code = $_GET['procode'];

        //データベース接続
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //SQLの実行
        $sql = "SELECT name,price,image FROM mst_product WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);

        //表示
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['name'];
        $pro_price = $rec['price'];
        $pro_image_name = $rec['image'];

        //データベースから切断
        $dbh = null;

        //画像表示タグの準備
        if($pro_image_name == ''){
            $disp_image = '';
        }else{
            $disp_image = "<img src='../product/images/".$pro_image_name."'>";
        }
        echo "<a href='shop_cartin.php?procode='".$pro_code."'>カートに入れる</a><br>";
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>
    <h2>商品情報参照</h2>
    <h3>商品コード</h3>
    <p><?php echo $pro_code; ?></p>
    <h3>商品名</h3>
    <p><?php echo $pro_name; ?></p>
    <h3>価格</h3>
    <p><?php echo $pro_price; ?></p>
    <?php echo $disp_image; ?>
    <br>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</body>
</html>