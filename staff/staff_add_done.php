<?php
require_once('../env.php');
require_once('../common.php');

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
    echo "ログインされていません<br>";
    echo "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    exit();
}else{
    echo $_SESSION['staff_name']."さんログイン中<br>";
}
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

        //入力データを受け取って変数に格納
        $post = sanitize($_POST);
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];
        

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

    <a href="staff_list.php">スタッフ一覧に戻る</a>
</body>
</html>