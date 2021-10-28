<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/Show.php');
include(__DIR__ . '/header.php');

$get_item_name = $_GET['name'];
$app = new \MyApp\Controller\Show();
$shows = $app->run();
$show = \MyApp\Controller\Show::find_by_name($shows,$get_item_name);
?>

<div class = "show-item">
  <div class = "item-images">
    <img src = "<?=h($show->img1)?>" class = "image1">
    <img src = "<?=h($show->img2)?>" class = "image2">
    <img src = "<?=h($show->img3)?>" class = "image3">
    <img src = "<?=h($show->img4)?>" class = "image4">

  </div>

  <div class = "item-show-name">
    <?=h($show->item_name)?>
  </div>

    <input type = "hidden" name = "item_id" value = "<?=h($show->item_id)?>">
    <input type = "hidden" id = "user_id" name = "user_id" value = "<?=h($_SESSION['me']->user_id)?>">
    <input type = "button" name = "favorite" id = "<?=$app->check_loged_in()?>" class = "get-favorite"  value = "♥">
    <input type = "hidden" name = "token" value = "<?=h($_SESSION['token'])?>">
  

  <div class = "item-price">
    ¥<?=number_format(h($show->price))?>  ( tax in )
  </div>

  <div class = "stock">在庫：<?=$show->stock?>個</div>

    <input type = "hidden" id = "item_id" name = "item_id" value = "<?=h($show->item_id)?>">
    <input type = "hidden" id = "item_name" name = "item_name" value = "<?=h($show->item_name)?>">
    <input type = "hidden" id = "img1" name = "img1" value = "<?=h($show->img1)?>">
    <input type = "hidden" id = "price" name = "price" value = "<?=h($show->price)?>" >
    <input type = "hidden" id = "stock" name = "stock" value = "<?=h($show->stock)?>">
    <input type = "hidden" id = "user_id" name = "user_id" value = "<?=h($_SESSION['me']->user_id)?>">
    <input type = "hidden" id = "cart_qty" name = "cart_qty" value = "1">
    <input type = "button" id = <?= $show->stock >=1 ? "cart-in":"back_order"?> value = <?= $show->stock >=1 ? "カートに入れる":"再入荷待ち"?>>
    <input type = "hidden" id = "token" name = "token" value  = "<?=h($_SESSION['token'])?>">


  <div class = "item-description">
    <?=nl2br(h($show->description))?>
  </div>

</div>

<div id = "mask"></div>
    <div id = "mordal" class = "mordal">
      <p class = "message">カートに追加しました</p>
      
      <a href = "cart.php" class = "look-cart">カートを見る</a>
      <div id = "close">お買い物を続ける</div>
    </div>

    <div id = "mordal2" class = "mordal">
      <p class = "message">お気に入りに追加しました</p>
      
      <a href = "favorite.php" class = "look-favorite">お気に入りを見る</a>
      <div id = "close2">閉じる</div>
    </div>

    <div id = "mordal3" class = "mordal">
      <p class = "message">お気に入り登録するにはログインが必要です</p>
      
      <a href = "login.php" class = "look-login">ログイン画面へ</a>
      <div id = "close3">閉じる</div>
    </div>



    <script src="jquery.min.js"></script>
    <script>
      
      $(function(){
       
        $('#cart-in').on('click',function(){
          $.ajax({
            url:'cart.php',
            type:'POST',
            data:{
              'item_id':$('#item_id').val(),
              'item_name':$('#item_name').val(),
              'img1':$('#img1').val(),
              'price':$('#price').val(),
              'stock':$('#stock').val(),
              'user_id':$('#user_id').val(),
              'cart_qty':$('#cart_qty').val(),
              'token':$('#token').val(),
           dataType:'json'

            }
          })

          .done( $(function(){
            $('#mask').fadeIn();
            $('#mordal').fadeIn();
          }))
        })

        $('#close').on('click',function(){
          $('#mask').fadeOut();
          $('#mordal').fadeOut();
        })
      })

      $(function(){
       
       $('#favorite-in').on('click',function(){
         $.ajax({
           url:'favorite.php',
           type:'POST',
           data:{
             'item_id':$('#item_id').val(),
             'user_id':$('#user_id').val(),
             'token':$('#token').val(),
          dataType:'json'

           }
         })

         .done( $(function(){
           $('#mask').fadeIn();
           $('#mordal2').fadeIn();
         }))
       })

       $('#close2').on('click',function(){
          $('#mask').fadeOut();
          $('#mordal2').fadeOut();
        })

     })

     $(function(){
       
       $('#no-login-favorite-in').on('click',function(){
           $('#mask').fadeIn();
           $('#mordal3').fadeIn();
       })

       $('#close3').on('click',function(){
         $('#mask').fadeOut();
         $('#mordal3').fadeOut();
       })
     })
           
    </script>

    <?php include(__DIR__ . '/footer.php');?>
  </body>
</html>

