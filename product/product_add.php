<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>野菜ショッピングサイト</title>
</head>
<body>
    <h2>商品追加</h2>
    <form action="product_add_check.php" method="post">
        <p>商品名を入力してください</p>
        <input type="text" name="name" style="width: 200px;">
        <p>価格を入力してください</p>
        <input type="text" name="price" style="width: 50px;">
        <p>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </p>
    </form>
</body>
</html>