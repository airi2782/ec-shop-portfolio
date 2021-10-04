<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/..//Model/User.php');

class Sign_up extends \MyApp\Controller\Controller{
  public function run(){
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
      $this->post_process();
    }
  }

  private function post_process(){
    try{
      $this->validate();
    }catch(\Exception $e){
      $this->set_errors('sign_up',$e->getMessage());
    }
  
    $this->set_values('user_name',$_POST['user_name']);
    $this->set_values('email',$_POST['email']);
    $this->set_values('phone_num',$_POST['phone_num']);
    $this->set_values('address',$_POST['address']);
    

    if($this->has_error){
      return;
    }else{
      try{
        $user_model = new \MyApp\Model\User();
        $user_model->sign_up([
          'user_name'=>$_POST['user_name'],
          'gender_id'=>$_POST['gender_id'],
          'email'=>$_POST['email'],
          'password'=>$_POST['password'],
          'phone_num'=>$_POST['phone_num'],
          'address'=>$_POST['address'],
          'payment_id'=>$_POST['payment_id']
        ]);
      
      }catch(\Exception $e){
        $this->set_errors('sign_up',$e->getMessage());
        return;
      }

      header('Location: login.php');
      exit;
     
    }

  }

  private function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
    }

    if(isset($_POST['user_name']) || empty($_POST['user_name'])){
      throw new \Exception('名前を入力してください');
    }
    if(isset($_POST['gender']) || empty($_POST['gender']) || $_POST['gender'] ==null){
      throw new \Exception('性別を選択してください');
    }
    if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
      throw new \Exception('メールアドレスが正しくありません');
    }
    if(!preg_match('/\A[a-zA-Z0-9]+\z/',$_POST['password'])){
      throw new \Exception('パスワードが正しくありません');
    }
    if(!preg_match('/^0\d{9,10}$/',$_POST['phone_num'])){
      throw new \Exception('電話番号が正しくありません');
    }
    if(isset($_POST['address']) || empty($_POST['address'])){
      throw new \Exception('住所を入力してください');
    }
    if(isset($_POST['payment']) || empty($_POST['payment'])){
      throw new \Exception('支払い方法を選択してください');
    }

    //電話番号　正しく番号を入力してください
  }
}