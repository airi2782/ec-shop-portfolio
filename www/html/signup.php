<?php
require_once(__DIR__ . '/../lib/Controller/Sign_up.php');
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\Sign_up();
$app->run();

?>

<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "utf-8">
<title>ec_shop</title>
<link rel = "stylesheet" href = "styles36.css">
</head>
<body>
<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">

    <div class = "sign-up">
      <h1 class = "signup-title">新規登録画面</h1>
      <form action = "" method = "post">
      <div class = "signup-error"><?=h($app->get_errors("sign_up"));?></div>
        <div class = "signup-input">　　　　　氏名：<input type = "text" id = "user_name" name = "user_name" placeholder = "例：山本　太郎" value = "<?=h($app->get_values('user_name'))?>"></div>
        <div class = "signup-input">
        <label>　　　　　　　性別：<input type = "radio"  name = "gender_id" value = 1>男性</label>
        <label><input type = "radio" name = "gender_id" value = 2>女性</label>
        <label><input type = "radio" name = "gender_id" value = 3>その他</label>
        </div>
        <div class = "signup-input">メールアドレス：<input type = "text" id = "email" name = "email" placeholder = "メールアドレス" value = "<?=h($app->get_values('email'));?>"></div>
        <div class = "signup-input">　　パスワード：<input type = "password" id = "password" name = "password" placeholder = "半角英数8〜20文字で入力" value = "<?=h($app->get_values('password'));?>"></div>
        <div class = "signup-input">　　　電話番号：<input type = "text" id = "phone_num" name = "phone_num" placeholder = "例：09011112222 ハイフン無" value = "<?=h($app->get_values('phone_num'));?>"></div>
        <div class = "signup-input">　　　　　住所：<input type = "text" id = "address" name = "address" placeholder = "例：○県△市□町●番地" value = "<?=h($app->get_values('address'));?>"></div>
        <div class = "signup-input">
        <label>　　　　　　　　　　　　　　　　　支払い方法：<input type = "radio" name = "payment_id" value = 1 >クレジットカード</label>
        <label><input type = "radio" name = "payment_id" value = 2 >銀行振込</label>
        <label><input type = "radio" name = "payment_id" value = 3 >後払い</label>
        <label><input type = "radio" name = "payment_id" value = 4 >代金引換</label>
        </div>
        <div class = "signup-botton"><input type = "submit" id = "sign_in" value = "新規登録"></div>
        <input type = "hidden" name = "token" value = "<?= h($_SESSION["token"])?>">
      </form>

      <div class = "go-login">既に登録済の方は<a href = "login.php">こちら</a></div>
      <div class = "go-home"><a href = "index.php">ホーム画面へ</a></div>

    </div>

    <?php include(__DIR__ . '/footer.php');?>
  </body>
</html>