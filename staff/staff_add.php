<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>野菜ショッピングサイト</title>
</head>
<body>
    <h2>スタッフ追加</h2>
    <form action="staff_add_check.php" method="post">
        <p>スタッフ名を入力してください</p>
        <input type="text" name="name" style="width: 200px;">
        <p>パスワードを入力してください</p>
        <input type="password" name="pass" style="width: 100px;">
        <p>パスワードをもう一度入力してください</p>
        <input type="password" name="pass2" style="width: 100px;">
        <p>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </p>
    </form>
</body>
</html>