<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/..//Model/Purchase_history.php');

class Purchase_histories extends \MyApp\Controller\Controller{
  public function run(){
    if(!isset($_SESSION['me']) || $_SESSION['me'] == null){
      echo "購入履歴を見るにはログインが必要です";
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
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->post_process();
    }
  }

  private function post_process(){
    try{
      $this->validate();
    }catch(\Exception $e){
        $this->set_errors('purchase',$e->getMessage());
    }
    try{
      //購入履歴を出力
      $purchase_history_model = new \MyApp\Model\Purchase_history();
      $purchase_histories = $purchase_history_model->get_purchase_history(['user_id'=>$_POST['user_id']]);
      $_SESSION['purchase_histories'] = $purchase_histories;
    }catch(\Exception $e){
      $this->set_errors('purchase_histry',$e->getMessage());
    }

  }

  private function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
    }

  }

}

    