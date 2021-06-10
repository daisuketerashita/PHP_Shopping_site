<?php
require_once('../env.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧ページ</title>
</head>
<body>
    <?php
    try{
        //データベース接続
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //SQLの実行
        $sql = "SELECT code,name,price FROM mst_product WHERE 1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        //データベースから切断
        $dbh = null;

        echo "<h2>商品一覧</h2>";
        echo "<form method='post' action='product_branch.php'>";

        while(true){
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false){
                break;
            }
            echo "<input type='radio' name='procode' value='".$rec["code"]."'>";
            echo $rec['name']."---";
            echo $rec['price'].'円';
            echo "<br>";
        }
        echo "<input type='submit' name='disp' value='参照'>";
        echo "<input type='submit' name='add' value='追加'>";
        echo "<input type='submit' name='edit' value='修正'>";
        echo "<input type='submit' name='delete' value='削除'>";
        echo "</form>";
    }catch(Exception $e){
        echo "失敗しました";
        exit();
    }
    ?>
</body>
</html>