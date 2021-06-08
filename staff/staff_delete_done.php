<?php
require_once('../env.php');
?>
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

    try{
        $staff_code = $_POST['code'];

        //データベースに接続
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //SQLの実行
        $sql = "DELETE FROM mst_staff WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_code;
        $stmt->execute($data);

        //データベースから切断
        $dbh = null;
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>
    <p>削除しました</p>
    <a href="staff_list.php">戻る</a>
</body>
</html>