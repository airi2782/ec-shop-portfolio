<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/Favorite.php');

class Delete_favorite extends \MyApp\Controller\Controller{
  public function run(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->post_process();
    }
  }

  private function post_process(){
    $this->validate();
    try{
      $favorite_model = new \MyApp\Model\Favorite();
      $favorite_model->delete_fav([
        'favorite_id'=>$_POST['delete_favorite_id'],
        'user_id'=>$_POST['user_id']
      ]);
      $favorite_items = $favorite_model->get_favorite([
        'user_id'=>$_POST['user_id']
        ]);
      $_SESSION['favorite_items'] = $favorite_items;
    }catch(\Exception $e){
      $this->set_errors('favorite',$e->getMessage());
      return;
    }

  }


  private function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
    }
  }
}