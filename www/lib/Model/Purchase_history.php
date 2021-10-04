<?php
namespace MyApp\Model;
require_once(__DIR__ . '/Model.php');

class Purchase_history extends \MyApp\Model\Model{
    //在庫を変更
    public function update_stock(){ 
    $stmt = $this->db->query('update items a,carts b set a.stock = a.stock - b.cart_qty where a.item_id = b.item_id');
  }
    //購入履歴を作成
    public function create_purchase_history($values){
      $stmt = $this->db->prepare('insert into purchase_histories(user_id,total_price,created_at,updated_at)
      value(:user_id,:total_price,now(),now())');
      $stmt->bindvalue(':user_id',$values['user_id']);
      $stmt->bindValue(':total_price',$values['total_price']);
      $stmt->execute();
    }
    //購入明細を作成
    public function create_purchase_detail($purchase_carts){
      foreach($purchase_carts as $purchase_cart){
        $purchase_history_id = 'LAST_INSERT_ID()';
        $item_id = $purchase_cart->item_id;
        $purchase_qty = $purchase_cart->cart_qty;
        $array_values[] = "({$purchase_history_id},{$item_id},{$purchase_qty})";
      }
      
      $stmt = $this->db->query("insert into purchase_detail_histories(purchase_history_id,item_id,purchase_qty)
      value" .join("," , $array_values));
    }
    //購入履歴を出力
    public function get_purchase_history($values){
      $stmt = $this->db->prepare('select * from purchase_histories where user_id = :user_id order by created_at desc');
      $stmt->bindValue(':user_id',$values['user_id']);
      $stmt->execute();
      $purchase_histories = $stmt->fetchAll(\PDO::FETCH_OBJ);
      return $purchase_histories;
    }
    // カートを削除
    public function delete_cart(){
      $this->db->query('delete from carts');
    }
    //購入明細を出力
    public function get_puchase_detail($values){
      $stmt = $this->db->prepare('select items.item_name,items.price,items.img1,
      purchase_detail_histories.purchase_history_id,purchase_detail_histories.purchase_qty,
      purchase_histories.total_price
       from purchase_detail_histories 
       inner join items
       on items.item_id = purchase_detail_histories.item_id AND purchase_history_id = :purchase_history_id
       inner join purchase_histories
       on purchase_histories.purchase_history_id = purchase_detail_histories.purchase_history_id');
      $stmt->bindValue(':purchase_history_id',$values['purchase_history_id']);
      $stmt->execute();
      $purchase_detail_histories = $stmt->fetchAll(\PDO::FETCH_OBJ);
      return $purchase_detail_histories;
    }
    //購入日時を出力
    public function get_purchase_time($values){
      $stmt = $this->db->prepare('select created_at from purchase_histories where purchase_history_id = :purchase_history_id');
      $stmt->bindValue(':purchase_history_id',$values['purchase_history_id']);
      $stmt->execute();
      $purchase_time = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $purchase_time;
    }
    
  
}