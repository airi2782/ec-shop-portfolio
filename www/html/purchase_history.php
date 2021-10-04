<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/Purchase_histories.php');
require_once(__DIR__ . '/../lib/Model/Purchase_history.php');
include(__DIR__ . '/header.php');

$purchase_history = new \MyApp\Controller\Purchase_histories();
$purchase_history->run();
$purchase_histories = $_SESSION['purchase_histories'];

?>

<h1 class = "purchase-history-title">購入履歴一覧</h1>

<div class = "purchase-histories">
  <div class = "history">
    <?php foreach($purchase_histories as $purchase_history):?>
      <form action = "purchase_detail.php" method = "post">
        <div class = "purchase-time"><?=h($purchase_history->created_at)?></div>
        <div>購入番号<?=h($purchase_history->purchase_history_id)?></div>
        <div>合計金額<?=number_format(h($purchase_history->total_price))?>円</div>
        <input type = "hidden" class = "purchase_history_id" name = "purchase_history_id" 
        value = <?=h($purchase_history->purchase_history_id)?>>
        <div class = show-detail><input type = "submit" value = "詳細を見る"></div>
        <input type = "hidden" class = "token" name = "token" value = "<?=h($_SESSION['token'])?>">
      </form>
    <?php endforeach ?>
  </div>

</div>

<?php include(__DIR__ . '/footer.php');?>

<script src="jquery.min.js"></script>
<script>
  
</script>
</body>
