<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/Favorite.php');

class In_favorite extends \MyApp\Controller\Controller{
  public function run(){
    if($_SERVER['REQUEST_METHOD'] =="POST"){
      $this->post_process();
    }
    if(!isset($_SESSION['favorite_items']) || $_SESSION['favorite_items'] == null){
      echo "現在お気に入り登録されているものはありません";
      echo "<p><a href = 'index.php?page=1'>ホーム画面へ戻る</a></p>";
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


  public function post_process(){
    $this->validate();
    try{
      if(!isset($_POST['item_id'])){
        $item_model = new \MyApp\Model\Favorite();
        $favorite_items = $item_model->get_favorite([
          'user_id'=>$_POST['user_id']
          ]);
        $_SESSION['favorite_items'] = $favorite_items;
      }else{
        $item_model = new \MyApp\Model\Favorite();
        $item_model->add_favorite([
          'item_id'=>$_POST['item_id'],
          'user_id'=>$_POST['user_id']
        ]);
  
        $favorite_items = $item_model->get_favorite([
          'user_id'=>$_POST['user_id']
          ]);
        $_SESSION['favorite_items'] = $favorite_items;
      }
      
    }catch(\Exception $e){
      $this->set_errors('favorite',$e->getMessage());
    }
  }

  private function validate(){
    //tokenがセットされていないまたはtokenが間違っていたら
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
      exit;
    }
  }



}
