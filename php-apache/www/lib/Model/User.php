<?php

namespace MyApp\Model;
require_once(__DIR__ . '/Model.php');

class User extends \MyApp\Model\Model{
  //サインインする
  public function sign_up($values){
    $stmt = $this->db->prepare('insert into users(user_name,gender_id,email,password,phone_num,address,payment_id,created_at,updated_at)
    value(:user_name,:gender_id,:email,:password,:phone_num,:address,:payment_id,now(),now())');

    $new_user = $stmt->execute([
      ':user_name'=>$values['user_name'],
      ':gender_id'=>$values['gender_id'],
      ':email'=>$values['email'],
      ':password'=>password_hash($values['password'],PASSWORD_DEFAULT),
      ':phone_num'=>$values['phone_num'],
      ':address'=>$values['address'],
      ':payment_id'=>$values['payment_id'],
    ]);
    if($new_user === false){
      throw new \Exception('このメールアドレスは既に使用されています');
    }
  }

  public function log_in($values){
    //ログインする
    $stmt = $this->db->prepare('select * from users 
    inner join payments on users.payment_id = payments.payment_id
    where email = :email');
    $stmt->bindValue(':email',$values['email']);
    $stmt->execute();
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    $user = $stmt->fetch();

    // if(isset($_SESSION['cart_items'])){
      
    // }
 
    if(empty($user)){
      throw new \Exception('メールアドレスまたはパスワードが間違っています');
    }

    if(!password_verify($values['password'],$user->password)){
      throw new \Exception('メールアドレスまたはパスワードが間違っています');
    }

    return $user;
  }
  
}