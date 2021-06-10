<?php
require_once('../env.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集画面</title>
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

        //各々データを格納
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['name'];
        $pro_price = $rec['price'];
        $pro_image_name_old = $rec['image'];

        //データベースから切断
        $dbh = null;

        if($pro_image_name_old == ''){
            $disp_image = '';
        }else{
            $disp_image = "<img src='./images/".$pro_image_name_old."'>";
        }
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>
    <h2>商品修正</h2>
    <p>商品コード</p>
    <p><?php echo $pro_code; ?></p>
    <form action="product_edit_check.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="code" value="<?php echo $pro_code; ?>">
        <input type="hidden" name="image_name_old" value="<?php echo $pro_image_name_old; ?>">
        <p>商品名</p>
        <input type="text" name="name" style="width: 200px;" value="<?php echo $pro_name; ?>">
        <p>価格</p>
        <input type="text" name="price" style="width: 50px;" value="<?php echo $pro_price; ?>">
        <br>
        <?php echo $disp_image; ?>
        <p>画像を選んでください</p>
        <input type="file" name="image" style="width: 400px">
        <br>
        <br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>
</html>