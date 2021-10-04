<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/Item.php');



class Show extends \MyApp\Controller\Controller{
  public function run(){
    $this->page();
    $this->offset();
    
    $item_model = new \MyApp\Model\Item();
    $shows = $item_model->items();
    return $shows;
  }

  public static function find_by_name($shows,$name){
    foreach($shows as $show){
      if($name == $show->item_name){
        return $show;
      }
    }
  }

  public function check_loged_in(){
    if(!isset($_SESSION['me']) || $_SESSION['me'] == null){
      return 'no-login-favorite-in';
    }else{
      return 'favorite-in';
    }
  }
}