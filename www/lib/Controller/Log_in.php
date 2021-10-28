<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/..//Model/User.php');

class Log_in extends \MyApp\Controller\Controller{
  public function run(){
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
      $this->post_process();
    }
  }

  private function post_process(){
    try{
      $this->validate();
    }catch(\Exception $e){
      $this->set_errors('log_in',$e->getMessage());
    }

    $this->set_values('email',$_POST['email']);

    //エラーが入っていないかチェックする
    if($this->has_errors()){
      return;
      //エラーが入っていなければログイン処理
    }else{
      try{
        $user_model = new \MyApp\Model\User();
        $user = $user_model->log_in([
          'email'=>$_POST['email'],
          'password'=>$_POST['password']
        ]);
      }catch(\Exception $e){
        $this->set_errors('log_in',$e->getMessage());
        return;
      }
      session_regenerate_id(true);
      $_SESSION['me'] = $user;

      //もしカートに何か入っていたらデータをcartテーブルに移す
      if(isset($_SESSION['cart_items'])){
        try{
          $cart_model = new \MyApp\Model\Cart();
          $cart_model->change_carts_data($_SESSION['cart_items']);
    
          $cart_items = $cart_model->get_cart([
            'user_id'=>$_POST['user_id']
          ]);
          $_SESSION['cart_items'] = $cart_items;
          
  
        }catch(\Exception $e){
          $this->set_errors('log_in',$e->getMessage());
          return;
        }

      }

      //ホーム画面に飛ばす
      header('Location: index.php');
    }

  }

  private function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
    }
    if(!isset($_POST['email']) || !isset($_POST['password'])){
      throw new \Exception('メールアドレスまたはパスワードが間違っています');
    }
    if($_POST['email'] === '' || $_POST['password' === '']){
      throw new \Exception('メールアドレスとパスワードを入力してください');
    }
  }
}