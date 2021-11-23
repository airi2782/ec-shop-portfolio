<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/..//Model/Purchase_history.php');

class Purchase_detail extends \MyApp\Controller\Controller{
  public function run(){
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
      //購入明細を出力
      $purchase_detail_model = new \MyApp\Model\Purchase_history();
      $purchase_details = $purchase_detail_model->get_puchase_detail(['purchase_history_id'=>$_POST['purchase_history_id']]);
        $_SESSION['purchase_details'] = $purchase_details;
    }catch(\Exception $e){
        $this->set_errors('purchase_detail',$e->getMessage());
    }

    try{
      //購入時間を出力
      $purchase_detail_model = new \MyApp\Model\Purchase_history();
      $purchase_time = $purchase_detail_model->get_purchase_time(['purchase_history_id'=>$_POST['purchase_history_id']]);
        $_SESSION['purchase_time'] = $purchase_time;
    }catch(\Exception $e){
        $this->set_errors('purchase_detail',$e->getMessage());
    }
  }

  private function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
    }

  }

}


