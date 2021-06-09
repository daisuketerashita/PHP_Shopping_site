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

    $pro_name = $_POST['name'];
    $pro_price = $_POST['price'];

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
    ?>
    <?php if($pro_name == '' || preg_match('/\A[0-9]+\z/',$pro_price) == 0): ?>
    <form>
        <input type='button' onclick='history.back()' value='戻る'>
    </form>
    <?php else: ?>
    <p>上記の商品を追加します</p>
    <form action="product_add_done.php" method="post">
        <input type="hidden" name="name" value="<?php echo $pro_name; ?>">
        <input type="hidden" name="price" value="<?php echo $pro_price; ?>">
        <br>
        <input type='button' onclick='history.back()' value='戻る'>
        <input type="submit" value="OK">
    </form>
    <?php endif; ?> 
</body>
</html>