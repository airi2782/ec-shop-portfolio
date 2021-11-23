<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/Cart.php');

class Update_cart extends \MyApp\Controller\Controller{
  public $cart_qty;
  public function run(){
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
      $this->post_process();
    }
  }

  private function post_process(){
   $this->validate();
  //  if($this->has_error){
  //   return;
  // }else{
    if(!isset($_SESSION['me']) || $_SESSION['me'] == null){
      try{
        $cart_model = new \MyApp\Model\Cart();
        $cart_model->select_no_login_qty($_POST['update_array_num'],$_POST['cart_qty']);
        return $_SESSION['cart_items'];

      }catch(\Exception $e){
        $this->set_errors('update_cart',$e->getMessage());
      }
    }
      try{
        $cart_model = new \MyApp\Model\Cart();
        $cart_model->select_qty([
          'cart_qty'=>$_POST['cart_qty'],
          'cart_id'=>$_POST['update_cart_id']
        ]);

        $cart_items = $cart_model->get_cart([
          'user_id'=>$_POST['user_id']
        ]);
        $_SESSION['cart_items'] = $cart_items;
        
      }catch(\Exception $e){
        $this->set_errors('update_cart',$e->getMessage());
      }

     
    // }
  }

  private function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
    }
  }
}