<?php
session_start();
session_regenerate_id(true);

require_once('../common.php');

$post = sanitize($_POST);

$max = $post['max'];
for($i = 0;$i < $max;$i++){
    $number[] = $post['number'.$i];
}

$cart = $_SESSION['cart'];

for($i = $max;0 <= $i;$i--){
    if(isset($_POST['delete'.$i]) == true){
        array_splice($cart,$i,1);
        array_splice($number,$i,1);
    }
}

$_SESSION['cart'] = $cart;
$_SESSION['number'] = $number;

header('Location: shop_cartlook.php');
exit();

?>