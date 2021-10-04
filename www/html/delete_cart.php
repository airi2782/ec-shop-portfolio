<?php
  require_once(__DIR__ . '/../config/config.php');
  require_once(__DIR__ . '/../lib/Controller/Delete_cart.php');
  $delete_cart = new \MyApp\Controller\Delete_cart();
  $delete_cart->run();
?>

