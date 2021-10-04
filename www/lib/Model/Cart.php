<?php

namespace MyApp\Model;
require_once(__DIR__ . '/Model.php');

class Cart extends \MyApp\Model\Model{
  //カートに入れる(未ログイン時)
  public function add_no_login_cart($values){
    $stmt = $this->db->prepare(
      'insert into no_login_carts(item_id,cart_qty,created_at,updated_at)
      value(:item_id,:cart_qty,now(),now())');
    $stmt->bindValue(':item_id',$values['item_id']);
    $stmt->bindValue(':cart_qty',$values['cart_qty']);
    $new_cart = $stmt->execute(); 
  }

  //カートに入れる(ログイン時)
  public function add_cart($values){
    $stmt = $this->db->prepare(
      'insert into carts(item_id,user_id,cart_qty,created_at,updated_at)
      value(:item_id,:user_id,:cart_qty,now(),now())');
    $stmt->bindValue(':item_id',$values['item_id']);
    $stmt->bindValue(':user_id',$values['user_id']);
    $stmt->bindValue(':cart_qty',$values['cart_qty']);
    $new_cart = $stmt->execute();   
  }

   //カート情報を取得(未ログイン時)
   public function get_no_login_cart(){
    $stmt = $this->db->query('select * from no_login_carts 
    inner join items on no_login_carts.item_id = items.item_id');
    $cart_items = $stmt->fetchAll(\PDO::FETCH_OBJ);
    return $cart_items[0];
  }

  //カート情報を取得(ログイン時)
  public function get_cart($values){
    $stmt = $this->db->prepare('select * from carts 
    inner join items on carts.item_id = items.item_id 
    where user_id = :user_id');
    $stmt->bindValue(':user_id',$values['user_id']);
    $stmt->execute();
    $cart_items = $stmt->fetchAll(\PDO::FETCH_OBJ);
    return $cart_items;
  }
  //カート全体を削除(未ログイン時)
  public function delete_no_login_cart(){
    $this->db->query('delete from no_login_carts');
  }
  //カート全体を削除(ログイン時)
  public function delete_cart(){
    $this->db->query('delete from carts');
  }
  //カートの商品を個別で削除(未ログイン時)
  public function delete_no_login_item($values){
    unset($_SESSION['cart_items'][$values]);
  }
  //カートの商品を個別で削除(ログイン時)
  public function delete_item($values){
    $stmt = $this->db->prepare('delete from carts where cart_id = :cart_id');
    $stmt->bindValue(':cart_id',$values['cart_id']);
    $stmt->execute();
  }
  //個数を変更(未ログイン時)
  public function select_no_login_qty($values,$qty){
    $_SESSION['cart_items'][$values]->cart_qty = $qty;
  }

  //個数を変更(ログイン時)
  public function select_qty($values){
    $stmt = $this->db->prepare("update carts set cart_qty = :cart_qty where cart_id = :cart_id");
    $stmt->bindValue(':cart_qty',$values['cart_qty'] );
    $stmt->bindValue(':cart_id',$values['cart_id']);
    $stmt->execute();
  }

  //未ログインカートのデータをログイン後カートのDBに入れ替える
  public function change_carts_data($cart_items){
    foreach($cart_items as $cart_item){
      // $cart_id = $cart_item->no_login_cart_id;
      $item_id = $cart_item->item_id;
      $user_id = $_SESSION['me']->user_id;
      $cart_qty = $cart_item->cart_qty;
      $created_at = 'now()';
      $updated_at = 'now()';
      $array_values[] = "({$item_id},{$user_id},{$cart_qty},{$created_at},{$updated_at})";
   
    }

    $stmt = $this->db->query("insert into carts(item_id,user_id,cart_qty,created_at,updated_at)
    value" .join("," , $array_values));
    // var_dump($array_values);
    // var_dump($_SESSION['cart_items']);
    
  }
  
    
}