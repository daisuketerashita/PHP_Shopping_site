<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
    echo "ログインされていません<br>";
    echo "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    exit();
}

//参照ページへ
if(isset($_POST['disp']) == true){
    if(isset($_POST['procode']) == false){
        header('Location: product_ng.php');
        exit();
    }
    $pro_code = $_POST['procode'];
    header('Location: product_disp.php?procode='.$pro_code);
    exit();
}

//追加ページへ
if(isset($_POST['add']) == true){
    header('Location: product_add.php');
    exit();
}

//編集ページへ
if(isset($_POST['edit']) == true){
    if(isset($_POST['procode']) == false){
        header('Location: product_ng.php');
        exit();
    }
    $pro_code = $_POST['procode'];
    header('Location: product_edit.php?procode='.$pro_code);
    exit();
}

//削除ページへ
if(isset($_POST['delete'])){
    if(isset($_POST['procode']) == false){
        header('Location: product_ng.php');
        exit();
    }
    $pro_code = $_POST['procode'];
    header('Location: product_delete.php?procode='.$pro_code);
    exit();
}
?>