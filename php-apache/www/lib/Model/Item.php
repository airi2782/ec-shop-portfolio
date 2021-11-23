<?php

namespace MyApp\Model;
require_once(__DIR__ . '/Model.php');

class Item extends \MyApp\Model\Model{

  //商品を追加する
  public function add_item($values){
    $stmt = $this->db->prepare('insert into items(item_category_id,flower_type_id,item_name,price,stock,description,
    img1,img2,img3,img4,created_at,updated_at)
    value(:item_category_id,:flower_type_id,:item_name,:price,:stock,:description,
    :img1,:img2,:img3,:img4,now(),now())');
    $stmt->bindValue(':item_category_id',$values['item_category_id']);
    $stmt->bindValue(':flower_type_id',$values['flower_type_id']);
    $stmt->bindValue(':item_name',$values['item_name']);
    $stmt->bindValue(':price',$values['price']);
    $stmt->bindValue(':stock',$values['stock']);
    $stmt->bindValue(':description',$values['description']);
    $stmt->bindValue(':img1',$values['img1']);
    $stmt->bindValue(':img2',$values['img2']);
    $stmt->bindValue(':img3',$values['img3']);
    $stmt->bindValue(':img4',$values['img4']);
    $stmt->execute();
  }
  
  //商品情報を全て取得(1ページに8件)
  public function all_item($values){
    $stmt = $this->db->prepare('select * from items 
    order by item_id limit :offset,:item_per_page');
    $stmt->bindValue(':offset',(int)$values['offset'],\PDO::PARAM_INT);
    $stmt->bindValue(':item_per_page',(int)$values['item_per_page'],\PDO::PARAM_INT);
    $stmt->execute();
    $items = $stmt->fetchAll(\PDO::FETCH_OBJ);
    return $items;
  }

  //商品情報を全て取得（そのまま）
  public function items(){
    $stmt = $this->db->query('select * from items order by item_id');
    $items = $stmt->fetchAll(\PDO::FETCH_OBJ);
    return $items;
  }

  //商品件数カウント
  public function count_item(){
    $stmt = $this->db->query('select count(*) from items');
    return $total = $stmt->fetchColumn();
  }  

  
}