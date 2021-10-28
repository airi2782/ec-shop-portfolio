<?php
require_once(__DIR__ . '/../config/config.php');
include(__DIR__ . '/header.php');
?>

<div class = "title">

  <div class = "title-images">
    <img src = "pic/title3.png" id = "img3" class = "title-image">
    <img src = "pic/title2.png" id = "img2" class = "title-image">
    <img src = "pic/title1.png" id = "img1" class = "title-image">
  </div>

  <h1 class = "title_logo">HandMade*</h1>

</div>

<h2>Shop'sItem</h2>

<div class = "items">
  <?php foreach($items as $item):?>
  <div class = "item">
  <a href = 'show.php?name=<?= h($item->item_name)?>'><img src = "<?= h($item->img1) ?>" class = "item-image"></a>
    <p class = "item-name">
      <a href = 'show.php?name=<?= h($item->item_name)?>'>
      <?= h($item->item_name)?></a>
    </p>
    <p class="item-price">¥<?= number_format(h($item->price)); ?>  ( tax in )</p>
  </div>
  <?php endforeach ?>
</div>

<div class = "pagenation">
  <p>全<?=h($app->total())?>件中、<?=h($app->from())?>件〜<?=h($app->to())?>件を表示しています</p>
  <?php if($app->page() > 1):?>
   <a href = "?page=<?=h($app->page() - 1)?>" class = "page">＜前へ</a>
  <?php endif ?>
  <?php for ($i = 1; $i <= $app->total_page(); $i++) :?>
    <?php if($app->page() == $i):?>
      <strong><a href = "?page=<?=h($i)?>" class = "page"><?=h($i)?></a></strong>
    <?php else :?>
      <a href = "?page=<?=h($i)?>" class = "page"><?=h($i)?></a>
    <?php endif ?>
  <?php endfor ?>
  <?php if($app->page() < $app->total_page()):?>
    <a href = "?page=<?=h($app->page() + 1)?>" class = "page">次へ＞</a>
  <?php endif ?>
</div>

<script src="jquery.min.js"></script>
  <script>
    $('.menu dd').hide();
    $('.menu dt').on('click',function(){
      $(this).next().slideToggle();
    })
  </script>

</body>
</html>