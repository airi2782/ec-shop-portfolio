<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/Cart.php');

class Delete_cart extends \MyApp\Controller\Controller{
  public function run(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->post_process();
    }
  }

  private function post_process(){
    $this->validate();
    //もしログインしていなかったら
    if(!isset($_SESSION['me']) || $_SESSION['me'] == null){
      try{
        $cart_model = new \MyApp\Model\Cart();
        $cart_model->delete_no_login_item($_POST['delete_array_num']);
      }catch(\Exception $e){
      $this->set_errors('delete_cart',$e->getMessage());
      }
    }else{
      try{
        $cart_model = new \MyApp\Model\Cart();
        $cart_model->delete_item([
          'cart_id'=>$_POST['delete_cart_id']
        ]);
        $cart_items = $cart_model->get_cart([
          'user_id'=>$_POST['user_id']
        ]);
        $_SESSION['cart_items'] = $cart_items;
      }catch(\Exception $e){
        $this->set_errors('delete_cart',$e->getMessage());
      }
    }
    
  }


  private function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
    }
  }
}