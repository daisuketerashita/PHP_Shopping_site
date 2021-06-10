<?php
require_once('../env.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品削除</title>
</head>
<body>
    <?php

    try{
        $pro_code = $_POST['code'];
        $pro_image_name = $_POST['image_name'];

        //データベースに接続
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //SQLの実行
        $sql = "DELETE FROM mst_product WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);

        //データベースから切断
        $dbh = null;

        if($pro_image_name !== ''){
            unlink('./images/'.$pro_image_name);
        }
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>
    <p>削除しました</p>
    <a href="product_list.php">戻る</a>
</body>
</html>