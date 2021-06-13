<?php
require_once('../env.php');
require_once('../common.php');
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
        $post = sanitize($_POST);
        $pro_code = $post['code'];
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        
        $pro_image_name_old = $_POST['image_name_old'];
        $pro_image_name = $_POST['image_name'];

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