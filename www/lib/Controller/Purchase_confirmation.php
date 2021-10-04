<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/..//Model/Purchase_history.php');

class Purchase_confirmation extends \MyApp\Controller\Controller{
  public function run(){
    if(!isset($_SESSION['me']) || $_SESSION['me'] == null){
      echo "購入するにはログインが必要です";
      echo "<p><a href = login.php>ログイン画面へ</a></p>";
      echo "<script src='jquery.min.js'></script>
      <script>
        $('.menu dd').hide();
        $('.menu dt').on('click',function(){
          $(this).next().slideToggle();
        })
      </script>
      </body>
      </html>";
      exit;
    }
  }
}