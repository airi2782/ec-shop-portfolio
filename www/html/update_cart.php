<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/Update_cart.php');


$cart_update = new \MyApp\Controller\Update_cart();
$cart_update->run();

header('Location: cart.php');
// var_dump($_POST['update_array_num']);
// var_dump($_POST['cart_qty']);
// var_dump($_SESSION['cart_items']);
?>
<a href = "cart.php">カートを見る</a>