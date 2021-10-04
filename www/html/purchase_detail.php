<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/Purchase_detail.php');
// require_once(__DIR__ . '/../lib/Model/Purchase_histry.php');
include(__DIR__ . '/header.php');

$purchase_detail_history = new \MyApp\Controller\Purchase_detail();
$purchase_detail_history->run();
$purchase_details = $_SESSION['purchase_details'];
$purchase_time = $_SESSION['purchase_time'];
// var_dump($purchase_time);
// var_dump($_SESSION['purchase_time']);

?>

<div class = "purchase-detail-text">
  <h1>購入明細</h1>
  <div class = "purchase_time">購入日時：<?=h($purchase_time['created_at'])?></div>

  <?php foreach($purchase_details as $purchase_detail):?>

    <a href = 'show.php?name=<?= h($purchase_detail->item_name)?>'><img src = '<?=isset($purchase_detail->img1)?$purchase_detail->img1:''?>' class = "purchase-item-image"></a>
    <div class = "purchase-item-name"><a href = 'show.php?name=<?= h($purchase_detail->item_name)?>'><?=isset($purchase_detail->item_name)?$purchase_detail->item_name:''?></a>
    </div>
    <div class = "purchase-item-price">金額　<?=isset($purchase_detail->price)?number_format(h($purchase_detail->price)):''?>円</div>
    <div class = "purchase-item-qty">個数　　　<?=isset($purchase_detail->purchase_qty)?$purchase_detail->purchase_qty:''?>個</div>

  <p>小計　<?=number_format(h($purchase_detail_history->sub_total_price($purchase_detail->price,$purchase_detail->purchase_qty)))?>円</p>

  <? endforeach ?>
  <p class = "total-price">合計　<?=isset($purchase_detail->total_price)?number_format(h($purchase_detail->total_price )):'' ?>円</p>
</div>
<?php include(__DIR__ . '/footer.php');?>
</body>
</html>