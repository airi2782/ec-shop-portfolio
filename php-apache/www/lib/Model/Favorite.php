<?php
namespace MyApp\Model;
require_once(__DIR__ . '/Model.php');

class Favorite extends \MyApp\Model\Model{
  //お気に入りに追加
  public function add_favorite($values){
    $stmt = $this->db->prepare('insert into favorites(item_id,user_id,created_at,updated_at)
    value(:item_id,:user_id,now(),now())');
    $stmt->bindValue(':item_id',$values['item_id']);
    $stmt->bindValue(':user_id',$values['user_id']);
    $stmt->execute();
  }

  //お気に入り商品情報を取得
  public function get_favorite($values){
    $stmt = $this->db->prepare('select * from favorites 
    inner join items on favorites.item_id = items.item_id
    where user_id = :user_id');
    $stmt->bindValue(':user_id',$values['user_id']);
    $stmt->execute();
    $favorite_items = $stmt->fetchAll(\PDO::FETCH_OBJ);
    return $favorite_items;
  }

  
  //お気に入りの商品を個別で削除
  public function delete_fav($values){
    $stmt = $this->db->prepare('delete from favorites where favorite_id = :favorite_id 
    and user_id = :user_id');
    $stmt->bindValue(':favorite_id',$values['favorite_id']);
    $stmt->bindValue(':user_id',$values['user_id']);
    $stmt->execute();
  }

    
}