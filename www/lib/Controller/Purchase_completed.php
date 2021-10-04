<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/..//Model/Purchase_history.php');

class Purchase_completed extends \MyApp\Controller\Controller{
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
      $purchase_history_model = new \MyApp\Model\Purchase_history();
      //トランザクション
      $purchase_history_model->db->beginTransaction();

      //在庫を変更
      $purchase_history_model->update_stock();

      //購入履歴を作成
      $purchase_history_model->create_purchase_history(['user_id'=>$_POST['user_id'],'total_price'=>$_POST['total_price']]);

      //購入明細を作成
      $purchase_history_id = 'LAST_INSERT_ID()';
      $array_values = "";
      $purchase_history_model->create_purchase_detail($_SESSION['cart_items']);

      //購入履歴を取り出して表示
      // $purchase_histories = $purchase_history_model->get_purchase_history(['user_id'=>$_POST['user_id']]);
      // $_SESSION['purchase_histories'] = $purchase_histories;

      //カートテーブルを削除
      $purchase_history_model->delete_cart();
      unset($_SESSION['cart_items']);
      
      //コミット
      $purchase_history_model->db->commit();

    }catch(\Exception $e){
      $this->set_errors('purchase',$e->getMessage());
      $purchase_history_model->db->rollBack();
    }

  }


  private function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
    }

  }
}


