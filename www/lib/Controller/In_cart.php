<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/Cart.php');

class In_cart extends \MyApp\Controller\Controller{
  public $total_price;
  public function run(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->post_process();
    }
    if(!isset($_SESSION['cart_items']) || $_SESSION['cart_items'] == null){
      var_dump($_SESSION['cart_items']);
      echo '現在カートには何も入っていません';
      echo "<p><a href = SITE_URL>ホーム画面へ戻る</a></p>";
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

  private function post_process(){
    $this->validate();
    //もしログインせずカートに入れたら
    if(!isset($_SESSION['me']) || $_SESSION['me'] == null){
      try{
        $cart_model = new \MyApp\Model\Cart();
        //未ログインユーザー用のDBに保存してSESSIONに移したらDBの内容は消す
        //その間はトランザクション
        $cart_model->db->beginTransaction();


        $cart_model->add_no_login_cart([
          'item_id'=>$_POST['item_id'],
          'cart_qty'=>$_POST['cart_qty']
        ]);

        $cart_items = $_SESSION['cart_items'];

        $cart_items[] = $cart_model->get_no_login_cart();

        $_SESSION['cart_items'] = $cart_items;

        $cart_model->delete_no_login_cart();

        $cart_model->db->commit();


      }catch(\Exception $e){
        $this->set_errors('cart',$e->getMessage());
      }
    }else{
      //ログイン後カートに入れたら
      try{
        $cart_model = new \MyApp\Model\Cart();
        $cart_model->add_cart([
          'item_id'=>$_POST['item_id'],
          'user_id'=>$_POST['user_id'],
          'cart_qty'=>$_POST['cart_qty']
        ]);
  
        $cart_items = $cart_model->get_cart([
          'user_id'=>$_POST['user_id']
        ]);
        $_SESSION['cart_items'] = $cart_items;
  
      }catch(\Exception $e){
        $this->set_errors('cart',$e->getMessage());
      } 
    }
  }

  private function validate(){
    //tokenがセットされていないまたはtokernが間違っていたら
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
      exit;
    }

  }

  //金額の小計を出す関数
  public function sub_total_price($price,$num){
    $sub_total_price = $price * $num;
    return $sub_total_price;  
  }

  //配列の番号を取得する
  public function array_search_num($value,$values){
    $array_num = array_search($value,$values);
    return $array_num;
  }


}