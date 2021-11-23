<?php 
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/In_cart.php');
require_once(__DIR__ . '/../lib/Controller/Log_in.php');
include(__DIR__ . '/header.php');

$in_cart = new \MyApp\Controller\In_cart();
$in_cart->run();
$purchase_confirmation = new \MyApp\Controller\Purchase_confirmation();
$purchase_confirmation->run();

$cart_items = $_SESSION['cart_items'];
$user = $_SESSION['me'];

?>
<div class = "purchase_confirmation">
<h1>購入確認画面</h1>
<h2>購入する商品</h2>
<div class = "box">
  <?php foreach($cart_items as $cart_item):?>
    <img src = '<?=isset($cart_item->img1)?$cart_item->img1:''?>' class = "cart-item-image">
    <div><?=h($cart_item->item_name)?></div>
    <div>金額　<?=isset($cart_item->price)?$cart_item->price:''?>円</div>
    <div>個数　<?=isset($cart_item->cart_qty)?$cart_item->cart_qty:''?>個</div>
  
    <h4>小計<?=number_format(h($in_cart->sub_total_price($cart_item->price,$cart_item->cart_qty)))?>円</h4>
    <?php $in_cart->total_price += $in_cart->sub_total_price($cart_item->price,$cart_item->cart_qty) ?>  

  <?php endforeach ?>
</div>

<h2 class = "address">届け先住所</h2>
<div class = "box">
  <div><?=isset($user->user_name)?$user->user_name:''?>　様</div>
  <div><?=isset($user->address)?$user->address:''?></div>
</div>
<h2 class = "payment">支払い方法</h2>
<div class = "box"><?=isset($user->payment_name)?$user->payment_name:''?></div>

<h4 class = "total-price">合計金額
 <?=isset($in_cart->total_price)?number_format(h($in_cart->total_price )):'' ?>円</h4>

<form action = "purchase_completed.php" method = "post">
  <input type = "hidden" name = "user_id" value = "<?=h($user->user_id)?>">
  <input type = "hidden" name = "total_price" value = "<?=h($in_cart->total_price)?>">
  <input type = "hidden" name = "token" value = "<?=h($_SESSION['token'])?>">
  <input type = "submit" value = "購入確定" class = "purchase_botton">
</form>
</div>
<?php include(__DIR__ . '/footer.php');?>
</body>
</html>