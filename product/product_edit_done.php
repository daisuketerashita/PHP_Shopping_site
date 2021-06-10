<?php
require_once('../env.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
</head>
<body>
    <?php
    try{
        $pro_code = $_POST['code'];
        $pro_name = $_POST['name'];
        $pro_price = $_POST['price'];
        $pro_image_name_old = $_POST['image_name_old'];
        $pro_image_name = $_POST['image_name'];

        $pro_code = htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
        $pro_name = htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
        $pro_price = htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

        //データベースに接続
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE mst_product SET name=?,price=?,image=? WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_name;
        $data[] = $pro_price;
        $data[] = $pro_image_name;
        $data[] = $pro_code;
        $stmt->execute($data);

        $dbh = null;

        echo "修正しました<br>";
        if($pro_image_name_old !== $pro_image_name){
            if($pro_image_name_old !== ''){
                unlink('./image/'.$pro_image_name_old);
            }
        }
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>
    <a href="product_list.php">戻る</a>
</body>
</html>