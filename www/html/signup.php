<?php
require_once(__DIR__ . '/../lib/Controller/Sign_up.php');
require_once(__DIR__ . '/../config/config.php');
// require_once(__DIR__ . '/header.php');
$app = new MyApp\Controller\Sign_up();
$app->run();

?>
<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "utf-8">
<title>ec_shop</title>
<link rel = "stylesheet" href = "styles10.css">
</head>
<body>
<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">

    <div class = "sign-up">
      <h1>新規登録画面</h1>
      <form action = "" method = "post">
      <div class = "error"><?=h($app->get_errors("sign_up"));?></div>
        <p>　　　　　氏名：<input type = "text" id = "user_name" name = "user_name" placeholder = "例：山本　太郎" value = "<?=h($app->get_values('user_name'));?>"></p>
        <label>　　　　　性別：<input type = "radio"  name = "gender_id" value = 1>男性</label>
        <label><input type = "radio" name = "gender_id" value = 2>女性</label>
        <label><input type = "radio" name = "gender_id" value = 3>その他</label>
        <p>メールアドレス：<input type = "text" id = "email" name = "email" placeholder = "メールアドレス" value = "<?=h($app->get_values('email'));?>"></p>
        <p>　　パスワード：<input type = "password" id = "password" name = "password" placeholder = "半角英数8〜20文字で入力" value = "<?=h($app->get_values('password'));?>"></p>
        <p>　　　電話番号：<input type = "text" id = "phone_num" name = "phone_num" placeholder = "例：09011112222 ハイフン無" value = "<?=h($app->get_values('phone_num'));?>"></p>
        <p>　　　　　住所：<input type = "text" id = "address" name = "address" placeholder = "例：○県△市□町●番地" value = "<?=h($app->get_values('address'));?>"></p>
        <label>　　支払い方法：<input type = "radio" name = "payment_id" value = 1 >クレジットカード</label>
        <label><input type = "radio" name = "payment_id" value = 2 >銀行振込</label>
        <label><input type = "radio" name = "payment_id" value = 3 >後払い</label>
        <label><input type = "radio" name = "payment_id" value = 4 >代金引換</label>
        <p><input type = "submit" id = "sign_in" value = "新規登録"></p>
        <input type = "hidden" name = "token" value = "<?= h($_SESSION["token"])?>">
      </form>

      <p>既に登録済の方は<a href = "login.php">こちら</a></p>

    </div>
    <div id = "mask"></div>
    <div id = "mordal">
      <p>新規登録完了</p>
      <a href = "login.php" class = "go-login">ログイン画面へ</a>
      <a href = SITE_URL>ホームに戻る</a>
      <div id = "close">閉じる</div>
    </div>

    <!-- <script src="jquery.min.js"></script>
    <script>
      
      $(function(){
       
        $('#sign_in').on('click',function(){
          $.ajax({
            url:'signup.php',
            type:'POST',
            data:{
              'user_name':$('#user_name').val(),
              'gender_id':$('.gender_id').val(),
              'email':$('#email').val(),
              'password':$('#password').val(),
              'phone_num':$('#phone_num').val(),
              'address':$('#address').val(),
              'payment_id':$('.payment_id').val(),
              'token':$('#token').val(),
           dataType:'json'

            }
          })

          .done( $(function(){
            $('#mask').fadeIn();
            $('#mordal').fadeIn();
          }))
        })
      });
           
    </script> -->
    <?php include(__DIR__ . '/footer.php');?>
  </body>
</html>