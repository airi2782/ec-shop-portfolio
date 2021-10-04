<?php

namespace MyApp\Model;

class Model{
  public $db;

  public function __construct(){
    try{
      $this->db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD,
      [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
    );
    }catch(\PDOException $e){
      echo $e->getMessage();
      exit;
    }
  }
 
}