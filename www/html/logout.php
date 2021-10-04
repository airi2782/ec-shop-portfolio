<?php
  require_once(__DIR__ . '/../config/config.php');
  require_once(__DIR__ . '/../lib/Model/Cart.php');

  if($_SERVER['REQUEST_METHOD']='POST'){
    if(isset($_POST['token']) || $_POST['token'] === $_SESSION['token']){
      echo "Tokenが間違っています";
    }

    //カートテーブルを空にする
    $cart_model = new \MyApp\Model\Cart();
    $cart_model->delete_cart();

    $_SESSION = [];

    if(isset($_COOKIE["PHPSESSID"])){
    setcookie("PHPSESSID",'',time()-1800,'/');
    }

    session_destroy();
  }

  header('Location: '.SITE_URL);