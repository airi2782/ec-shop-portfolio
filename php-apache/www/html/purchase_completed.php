<?php
require_once(__DIR__ . '/../config/config.php');
// require_once(__DIR__ . '/../lib/Controller/Purchase_completed.php');
require_once(__DIR__ . '/../lib/Model/Purchase_history.php');
include(__DIR__ . '/header.php');

$purchase_completed = new \MyApp\Controller\Purchase_completed();
$purchase_completed->run();

?>

<h1 class = "purchase-completed-text">購入完了致しました</h1>
<div class = "purchase-completed-text">※これはポートフォリオ用サイトです。本当に購入できたわけではありません</div>
<li>
  <form action = "purchase_history.php" method = "post" name = "go_purchase_history">
    <input type = "hidden" name = "user_id" value = "<?=h($_SESSION["me"]->user_id)?>">
    <input type = "hidden" name = "token" value = "<?= h($_SESSION["token"])?>">
    <a href = "javascript:go_purchase_history.submit()" class = "go-purchase-history">購入履歴一覧へ</a>
  </form>
</li>

<?php include(__DIR__ . '/footer.php');?>
</body>
</html>