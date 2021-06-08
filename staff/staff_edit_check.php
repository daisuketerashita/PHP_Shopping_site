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

    //入力データを受け取って変数に格納
    $staff_code = $_POST['code'];
    $staff_name = $_POST['name'];
    $staff_pass = $_POST['pass'];
    $staff_pass2 = $_POST['pass2'];

    //特殊文字を HTML エンティティに変換
    $staff_name = htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
    $staff_pass = htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');
    $staff_pass2 = htmlspecialchars($staff_pass2,ENT_QUOTES,'UTF-8');

    //スタッフ名の入力チェック
    if($staff_name == ""){
        echo 'スタッフ名が入力されていません<br>';
    }else{
        echo "スタッフ名：{$staff_name}<br>";
    }

    //パスワードの入力チェック
    if($staff_pass == ""){
        echo 'パスワードが入力されていません<br>';
    }

    //パスワードの一致チェック
    if($staff_pass !== $staff_pass2){
        echo 'パスワードが一致しません<br>';
    }

    //戻るボタンを表示
    if($staff_name == "" || $staff_pass == "" || $staff_pass !== $staff_pass2){
        echo "<form>";
        echo "<input type='button' onclick='history.back()' value='戻る'>";
        echo "</form>";
    }else{
        $staff_pass = md5($staff_pass);
        echo "<form method='post' action='staff_edit_done.php'>";
        echo "<input type='hidden' name='code' value='".$staff_code."'>";
        echo "<input type='hidden' name='name' value='".$staff_name."'>";
        echo "<input type='hidden' name='pass' value='".$staff_pass."'>";
        echo "<br>";
        echo "<input type='button' onclick='history.back()' value='戻る'>";
        echo "<input type='submit' value='OK'>";
        echo "<form>";
    }
    ?>
</body>
</html>