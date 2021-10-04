<?php
namespace MyApp\Controller;
require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/Item.php');

class Index extends \MyApp\Controller\Controller{

  public function run(){  
    $this->page();
    $this->offset();

    //もしPOSTなら商品追加
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
     $this->post_process();
    }

    $item_model = new \MyApp\Model\Item();
    $items = $item_model->all_item([
      'offset'=>$this->offset(),
      'item_per_page'=>ITEM_PER_PAGE
    ]);
    return $items;   
    
  }

  private function post_process(){
    $this->validate();

    // try{
    //↓いらなかったら除ける
     $item_model = new \MyApp\Model\Item();
    //   $item_model->add_item([
    //     'item_category_id'=>$_POST['item_category_id'],
    //     'flower_type_id'=>$_POST['flower_type_id'],
    //     'item_name'=>$_POST['item_name'],
    //     'price'=>$_POST['price'],
    //     'stock'=>$_POST['stock'],
    //     'description'=>$_POST['description'],
    //     'img1'=>$_POST['img1'],
    //     'img2'=>$_POST['img2'],
    //     'img3'=>$_POST['img3'],
    //     'img4'=>$_POST['img4'],
    //   ]);

    // }catch(\Exception $e){
    //   echo "商品追加でエラー";
    // }
  }

  private function validate(){
    //tokenがセットされていないまたはtokernが間違っていたら
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo 'tokenが間違っています';
      exit;
    }

  }

  public function logged_in_user(){
    if($this->is_logged_in()){
      return $_SESSION['me']->user_name;
    }else{
      return 'ゲスト';
    }
  }

  public function log_in_out(){
    if(isset($_SESSION['me']) && !empty($_SESSION['me'])){
      return 'logout';
    }else{
      return 'login';
    }
  }


  public function total(){
    $item_model = new \MyApp\Model\Item();
    $this->total = $item_model->count_item();
    return $this->total;
  }

  public function total_page(){
    $this->total();
    $this->total_page = ceil($this->total/ITEM_PER_PAGE);
    return $this->total_page;
  }

  public function from(){
    $this->offset();
    $this->from = $this->offset + 1;
    return $this->from;
  }

  public function to(){
    $this->offset();
    $this->total();
    $this->to = ($this->offset + ITEM_PER_PAGE) < $this->total ? ($this->offset + ITEM_PER_PAGE) : $this->total; 
    return $this->to;
  }
    

}