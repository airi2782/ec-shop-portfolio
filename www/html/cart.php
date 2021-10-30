<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/In_cart.php');
require_once(__DIR__ . '/../lib/Model/Cart.php');
include(__DIR__ . '/header.php');

$in_cart = new \MyApp\Controller\In_cart();
$in_cart->run();
$cart_items = $_SESSION['cart_items'];

?>

<h1 class = "cart-title">カート</h1>
<p class = "current-cart">現在のカートの中身は下記のとおりです。</p>
<div class = "cart">
  <ul id = "#carts">
  <?php foreach($cart_items as $cart_item):?>
  <li data-id = "<?=h($cart_item->cart_id)?>" data-array-num = "<?=h($in_cart->array_search_num($cart_item,$cart_items))?>">

    <a href = "show.php?name=<?=h($cart_item->item_name)?>"><img src = '<?=isset($cart_item->img1)?$cart_item->img1:''?>' class = "cart-item-image"></a>
    <a href = "show.php?name=<?=h($cart_item->item_name)?>" class = "cart-item-name"><?=h($cart_item->item_name)?></a>
    <div class = "cart-item-price"><?=number_format(h((float)$cart_item->price))?>円　( tax in )</div>
    <div class = "cart-item-qty">数量

    <form action = "update_cart.php" method = "post" class = "cart-qty">
      <select id = "cart_qty" name = "cart_qty">
        <?php for($i=1; $i<= $cart_item->stock; $i++ ):?>
          <option class = "js_num" <?php if($i == $cart_item->cart_qty){echo 'selected';}?>
          value = "<?= $i ?>"><?= $i ?></option>
        <?php endfor ?>
      </select>
      個</div>

      <input type = "hidden" class = "update_cart_id" name = "update_cart_id"  value = "<?=h($cart_item->cart_id)?>">
      <input type = "hidden" id = "user_id" name = "user_id" value = "<?=h($_SESSION['me']->user_id)?>">
      <input type = "hidden" id = "update_array_num" name = "update_array_num" value = "<?=h($in_cart->array_search_num($cart_item,$cart_items))?>">
      <input type = "submit" id = "update" class = "update"  value = "個数変更">
      <input type = "hidden" class = "token" name = "token" value = "<?=h($_SESSION['token'])?>">

    </form>
    <p>小計<?=number_format(h($in_cart->sub_total_price($cart_item->price,$cart_item->cart_qty)))?>円</p>

      <input type = "hidden" class = "delete_cart_id" name = "delete_cart_id" value = <?=h($cart_item->cart_id)?>>
      <input type = "hidden" id = "user_id" name = "user_id" value = "<?=h($_SESSION['me']->user_id)?>">
      <input type = "hidden" id = "delete_array_num" name = "delete_array_num" value = "<?=h($in_cart->array_search_num($cart_item,$cart_items))?>">
      <input type = "button" id = "delete" class = "delete" value = "削除">
      <input type = "hidden" class = "token" name = "token" value = "<?=h($_SESSION['token'])?>">

    <?php $in_cart->total_price += $in_cart->sub_total_price($cart_item->price,$cart_item->cart_qty) ?>  
  </li>

  <?php endforeach ?>
  </ul>
</div>



<p class = "total-price">合計金額
 <?=isset($in_cart->total_price)?number_format(h($in_cart->total_price )):'' ?>円
</p>

<a href = "purchase_confirmation.php" class = "go-confirmation">購入確認画面へ</a>
<a href = "cart_clear.php" class = "cart-clear">カートを空にする</a>


   <div id = "mask"></div>
    <div id = "mordal">
      <p class = "message">カートから削除しました</p>
      <a href = "cart.php" class = "look-cart">カートを見る</a>
    </div>
  
  

<script src="jquery.min.js"></script>
  <script>
     $(function(){
        $('.delete').on('click',function(){
          var id = $(this).parents('li').data('id');
          var array_num = $(this).parents('li').data('array-num');
          $.ajax({
             url:'delete_cart.php',
             type:'POST',
              data:{
                'delete_cart_id':id,
                'user_id':$('#user_id').val(),
                'delete_array_num':array_num,
                'token':$('.token').val(),
              dataType:'json' }
                })

            .done( $(function(){
              $('#mask').fadeIn();
              $('#mordal').fadeIn();}))
            })

           
      })

  </script>
  <?php include(__DIR__ . '/footer.php');?>
  </body>
  </html>
