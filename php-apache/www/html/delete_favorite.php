<?php
  require_once(__DIR__ . '/../config/config.php');
  require_once(__DIR__ . '/../lib/Controller/Delete_favorite.php');
  $delete_favorite = new \MyApp\Controller\Delete_favorite();
  $delete_favorite->run();
  // var_dump($_SESSION['favorite_items']);
?>