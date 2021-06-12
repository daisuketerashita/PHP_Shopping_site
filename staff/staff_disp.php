<?php
require_once('../env.php');
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
    <title>スタッフ参照画面</title>
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
    <h2>スタッフ情報参照</h2>
    <h3>スタッフコード</h3>
    <p><?php echo $staff_code; ?></p>
    <h3>スタッフ名</h3>
    <p><?php echo $staff_name; ?></p>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</body>
</html>