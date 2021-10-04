<?php
  require_once(__DIR__ . '/../config/config.php');
  require_once(__DIR__ . '/../lib/Model/Cart.php');

    $cart_model = new \MyApp\Model\Cart();
    $cart_model->delete_cart();
      
    unset($_SESSION['cart_items']);

    // $_SESSION['cartItems'] = [];

    // if(isset($_COOKIE["PHPSESSID"])){
    // setcookie("PHPSESSID",'',time()-1800,'/');
    // }

    // session_destroy();
  header('Location: '.SITE_URL);
  ?>

  
