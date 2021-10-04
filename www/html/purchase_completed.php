<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/Purchase_completed.php');
require_once(__DIR__ . '/../lib/Model/Purchase_history.php');
include(__DIR__ . '/header.php');

$purchase_completed = new \MyApp\Controller\Purchase_completed();
$purchase_completed->run();
// $purchase_histories = $_SESSION['purchase_histories'];

// var_dump($_POST["total_price"]);
// var_dump($_POST['cart_qty']);
// var_dump($_POST['item_id']);

// var_dump($_SESSION['purchase_histories']);
// var_dump($purchase_histories);
// echo $purchase_completed->get_errors('purchase');
?>

<h1>購入完了致しました</h1>
<li>
  <form action = "purchase_history.php" method = "post" name = "go_purchase_history">
    <input type = "hidden" name = "user_id" value = "<?=h($_SESSION["me"]->user_id)?>">
    <input type = "hidden" name = "token" value = "<?= h($_SESSION["token"])?>">
    <a href = "javascript:go_purchase_history.submit()" class = "purchase_history">購入履歴一覧へ</a>
  </form>
</li>
<?php var_dump($_SESSION['me']->user_id)?>

<?php include(__DIR__ . '/footer.php');?>
</body>
</html>