<?php

namespace MyApp\Controller;

class Controller{
  public $page;
  public $offset;
  public $total;
  public $total_pages;
  public $from;
  public $to;

  private $_error;
  private $_value;

  public function __construct(){
    if(!isset($_SESSION['token'])){
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }

    $this->_error = new \stdClass();
    $this->_value = new \stdClass();

  }

  protected function set_errors($key,$error){
    $this->_error->$key = $error;
  }

  protected function set_values($key,$value){
    $this->_value->$key = $value;
  }

  public function get_errors($key){
    if(isset($this->_error->$key)){
      return $this->_error->$key;
    }
  }

  public function get_values($key){
    if(isset($this->_value->$key)){
      return $this->_value->$key;
    }
  }

  protected function is_logged_in(){
    if(isset($_SESSION['me']) && !empty($_SESSION['me'])){
      return $_SESSION['me'];
    }
  }

  protected function has_errors(){
    if(!empty(get_object_vars($this->_error))){
      return $this->_error;
    }
  }

  public function page(){
    if(preg_match('/^[1-9][0-9]*$/',$_GET['page'])){
      return $this->page = (int)$_GET['page'];
    }else{
      return $this->page = 1;
    }
  }

  public function offset(){
    $this->offset = ITEM_PER_PAGE * ($this->page()-1);
    return $this->offset;
  }

  //金額の小計を出す関数
  public function sub_total_price($price,$num){
    $sub_total_price = $price * $num;
    return $sub_total_price;  
  }
}
