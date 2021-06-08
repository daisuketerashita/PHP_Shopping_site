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
        $staff_name = $_POST['name'];
        $staff_pass = $_POST['pass'];

        $staff_name = htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
        $staff_pass = htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

        //データベースに接続
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //SQLの実行
        $sql = "INSERT INTO mst_staff (name,password) VALUES (?,?)";
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_name;
        $data[] = $staff_pass;
        $stmt->execute($data);

        //データベースから切断
        $dbh = null;

        //画面表示
        echo $staff_name."さんを追加しました<br>";
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>

    <a href="staff_list.php">戻る</a>
</body>
</html>