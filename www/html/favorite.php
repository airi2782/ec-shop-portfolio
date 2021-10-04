<?php 
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/In_favorite.php');
include(__DIR__ . '/header.php'); 

$app = new \MyApp\Controller\In_favorite();
$app->run();
$favorite_items = $_SESSION['favorite_items'];
// var_dump($_SESSION['favorite_items']);
var_dump($_POST['user_id']);

?>

<h1 class = "favorite-title">お気に入り一覧</h1>
<div class = "favorite-item">
<ul id = "#favorits">
  <?php foreach($favorite_items as $favorite_item):?>
    <li data-id = "<?=h($favorite_item->favorite_id)?>" >
      <a href = 'show.php?name=<?= h($favorite_item->item_name)?>'><img src = '<?=h($favorite_item->img1)?>' class = "favorite-item-image"></a>
      <a href = "show.php?name=<?=h($favorite_item->item_name)?>" class = "favorite-item-name"><?=h($favorite_item->item_name)?></a>
      <div class = "cart-item-price"><?=number_format(h($favorite_item->price))?>円　( tax in )</div>

      <form action = "delete_favorite.php" method = "post">
        <input type = "hidden" class = "delete_favorite_id" name = "delete_favorite_id" value = <?=h($favorite_item->favorite_id)?>>
        <input type = "hidden" id = "user_id" name = "user_id" value = "<?=h($_SESSION['me']->user_id)?>">
        <input type = "button" class = "delete" value = "削除">
        <input type = "hidden" class = "token" name = "token" value = "<?=h($_SESSION['token'])?>">
      </form>

    </li>
  <?php endforeach ?>
  </ul>
</div>

<div id = "mask"></div>
    <div id = "mordal">
      <p class = "message">お気に入りから削除しました</p>
      <a href = "favorite.php" class = "look-favorite">お気に入りを見る</a>
    </div>

<script src="jquery.min.js"></script>
  <script>
     $(function(){
        $('.delete').on('click',function(){
          var id = $(this).parents('li').data('id');
          $.ajax({
             url:'delete_favorite.php',
             type:'POST',
              data:{
                'delete_favorite_id':id,
                'user_id':$('#user_id').val(),
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