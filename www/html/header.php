<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/Index.php');
require_once(__DIR__ . '/../lib/Model/Item.php');

$app =new \MyApp\Controller\Index();
$items = $app->run();

?>

<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "utf-8">
<title>ec_shop</title>
<link rel = "stylesheet" href = "styles36.css">
</head>
<body>
<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">

<a href = SITE_URL class = "home">HandMade*</a>
<div class = "greet">ようこそ　<?=h($app->logged_in_user())?>　様　　</div>
<div class = "header">
  <form action = "favorite.php" method = "post" name = "favorite">
    <input type = "hidden" name = "user_id" value = "<?=h($_SESSION["me"]->user_id)?>">
    <input type = "hidden" name = "token" value = "<?=h($_SESSION["token"])?>">
    <a href = "javascript:favorite.submit()" class = "favorite">♥</a>
  </form>
        <?=!isset($_SESSION['me'])?'<li><a href = "cart.php" class = "go-cart">cart</a></li>':
        "<form action = 'cart.php' method = 'post' name = 'cart'>
            <input type = 'hidden' name = 'user_id' value = ".$_SESSION['me']->user_id.">
            <input type = 'hidden' name = 'token' value = ".$_SESSION['token'].">
            <a href = 'javascript:cart.submit()' class = 'go-cart'>cart</a>
        </form>"
        ?>
  <dl class = "menu">
    <dt>menu</dt>
    <dd>
      <ul>
        <!-- <li><a href = "flower_type.php">お花の種類</a></li> -->
        <li><a href = "pack.php">包装について</a></li>
        <li><a href = "delivery.php">発送について</a></li>
        <li><form action = "purchase_history.php" method = "post" name = "purchase_history">
            <input type = "hidden" name = "user_id" value = "<?=h($_SESSION["me"]->user_id)?>">
            <input type = "hidden" name = "token" value = "<?= h($_SESSION["token"])?>">
            <a href = "javascript:purchase_history.submit()" class = "purchase_history">購入履歴</a>
            </form>
        </li>
      </ul>
    </dd>
  </dl>
  <a href = "<?=h($app->log_in_out())?>.php" class = "<?=h($app->log_in_out())?>"><?=h($app->log_in_out())?></a>
</div>