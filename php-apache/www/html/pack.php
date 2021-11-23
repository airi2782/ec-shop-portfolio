<?php include(__DIR__ . '/header.php'); ?>

<div class = "pack">
  <h1 class = "pack-title-logo">包装について</h1>
  <div class = "pack-text">
    当店ではギフト用の包装も行っております。<br>
    家族や友人、恋人など、大切なあの人へのプレゼントに是非。
  </div>
  <div class = pack-fade-text>
    <div class ="pack-sub-title" >包装例</div>
    <img src = "pic/pack/img2.png" id = "pack1" class = "pack-img">
    <div class = "pack-text">
      レース紙に麻のリボンというナチュラルかつ可愛らしいラッピング。<br>
      お好みでかすみ草を添えさせていただきます。
    </div>
    <img src = "pic/pack/img3.png" id = "pack2" class = "pack-img">
    <div class = "pack-text">
      中身はこのようになっております。
    </div>
  </div>
</div>
<div>
  
</div>

<?php include(__DIR__ . '/footer.php');?>
<script src="jquery.min.js"></script>
<script>
  window.onload = function(){
    fade_effect();

    $(window).scroll(function(){
      fade_effect();
    });

    function fade_effect(){
      $('.pack-fade-text').each(function(){
        const targetElement = $(this).offset().top;
        const scroll = $(window).scrollTop();
        const windowHeight = $(window).height();
        if(scroll > targetElement - windowHeight){
          $(this).addClass('view');
        }
      });
    };
  }
</script>
</body>
</html>