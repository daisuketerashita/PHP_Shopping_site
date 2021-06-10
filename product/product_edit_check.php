<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    //入力データを受け取って変数に格納
    $pro_code = $_POST['code'];
    $pro_name = $_POST['name'];
    $pro_price = $_POST['price'];
    $pro_image_name_old = $_POST['image_name_old'];
    $pro_image = $_FILES['image'];


    //特殊文字を HTML エンティティに変換
    $pro_code = htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
    $pro_name = htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
    $pro_price = htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

    if($pro_name == ''){
        echo '商品名を入力してください<br>';
    }else{
        echo "商品名：{$pro_name}"."<br>";
    }

    //もし半角英数字じゃなかったら
    if(preg_match('/\A[0-9]+\z/',$pro_price) == 0){
        echo '半角数字で入力してください';
    }else{
        echo "価格：{$pro_price}円<br>";
    }

    //画像の大きさをチェック
    if($pro_image['size'] > 0){
        if($pro_image['size'] > 1000000){
            echo "画像が大きすぎます";
        }else{
            move_uploaded_file($pro_image['tmp_name'],'./images/'.$pro_image['name']);
            echo "<img src='./images/".$pro_image['name']."'>";
            echo "<br>";
        }
    }

    ?>
    <?php if($pro_name == '' || preg_match('/\A[0-9]+\z/',$pro_price) == 0 || $pro_image['size'] > 1000000): ?>
    <form>
        <input type='button' onclick='history.back()' value='戻る'>
    </form>
    <?php else: ?>
    <p>上記の商品を変更します</p>
    <form action="product_edit_done.php" method="post">
        <input type="hidden" name="code" value="<?php echo $pro_code; ?>">
        <input type="hidden" name="name" value="<?php echo $pro_name; ?>">
        <input type="hidden" name="price" value="<?php echo $pro_price; ?>">
        <input type="hidden" name="image_name_old" value="<?php echo $pro_image_name_old; ?>">
        <input type="hidden" name="image_name" value="<?php echo $pro_image['name']; ?>">
        <br>
        <input type='button' onclick='history.back()' value='戻る'>
        <input type="submit" value="OK">
    </form>
    <?php endif; ?> 
</body>
</html>