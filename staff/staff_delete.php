<?php
require_once('../env.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ削除画面</title>
</head>
<body>
    <?php
    try{
        $staff_code = $_GET['staffcode'];

        //データベース接続
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //SQLの実行
        $sql = "SELECT name FROM mst_staff WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_code;
        $stmt->execute($data);

        //表示
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $staff_name = $rec['name'];

        //データベースから切断
        $dbh = null;
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>
    <h2>スタッフ削除</h2>
    <p>スタッフコード</p>
    <p><?php echo $staff_code; ?></p>
    <p>スタッフ名</p>
    <p><?php echo $staff_name; ?></p>
    <p>このスタッフを削除してもよろしいですか？</p>
    <form action="staff_delete_done.php" method="post">
        <input type="hidden" name="code" value="<?php echo $staff_code; ?>">
        <br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>
</html>