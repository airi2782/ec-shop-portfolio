<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Controller/Log_in.php');
// include(__DIR__ . '/header.php');
$app = new MyApp\Controller\Log_in();
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

    <div class = "log-in">
      <h1 class = "login-title">ログイン画面</h1>
      <div class = "login-error"><?=h($app->get_errors("log_in"));?></div>
      <form action = "" method = "post">
        <div class = "login-input">メールアドレス：<input type = "text" name = "email" placeholder = "メールアドレス" value = "<?=h($app->get_values('email'));?>"></div>
        <div class = "login-input">　　パスワード：<input type = "password" name = "password" placeholder = "パスワード"></div>
        <div class = "login-botton"><input type = "submit" value = "ログイン"></div>
        <input type = "hidden" name = "token" value = "<?= h($_SESSION["token"])?>">
      </form>

      <div class = "go-signup">新規登録の方は<a href = "signup.php">こちら</a></div>
      <div class = "go-home"><a href = "index.php">ホーム画面へ</a></div>

    </div>
    <?php include(__DIR__ . '/footer.php');?>
  </body>
</html>