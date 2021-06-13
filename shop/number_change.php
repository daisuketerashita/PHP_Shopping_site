<?php
session_start();
session_regenerate_id(true);

require_once('../common.php');

$post = sanitize($_POST);

$max = $post['max'];
for($i = 0;$i < $max;$i++){
    $number[] = $post['number'.$i];
}

$_SESSION['number'] = $number;

header('Location: shop_cartlook.php');
exit();

?>