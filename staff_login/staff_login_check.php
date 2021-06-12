<?php
require_once('../env.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインチェック</title>
</head>
<body>
    <?php
    try{
        $staff_code = $_POST['code'];
        $staff_pass = $_POST['pass'];

        $staff_code = htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
        $staff_pass = htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

        $staff_pass = md5($staff_pass);

        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_code;
        $data[] = $staff_pass;
        $stmt->execute($data);

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        if($rec == false){
            echo 'スタッフコードかパスワードが間違っています';
            echo "<a href='staff_login.html'>戻る</a>";
        }else{
            session_start();
            $_SESSION['login'] = 1;
            $_SESSION['staff_code'] = $staff_code;
            $_SESSION['staff_name'] = $rec['name'];
            header('Location: staff_top.php');
            exit();
        }
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>
</body>
</html>