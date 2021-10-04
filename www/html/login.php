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
<link rel = "stylesheet" href = "styles10.css">
</head>
<body>
<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">

    <div class = "log-in">
      <h1>ログイン画面</h1>
      <div class = "error"><?=h($app->get_errors("log_in"));?></div>
      <form action = "" method = "post">
        <p>メールアドレス：<input type = "text" name = "email" placeholder = "メールアドレス" value = "<?=h($app->get_values('email'));?>"></p>
        <p>　　パスワード：<input type = "password" name = "password" placeholder = "パスワード"></p>
        <p><input type = "submit" value = "ログイン"></p>
        <input type = "hidden" name = "token" value = "<?= h($_SESSION["token"])?>">
      </form>

      <p>新規登録の方は<a href = "signup.php">こちら</a></p>

      <p><a href = "administrator.php">管理者用ページ</a></p>
    </div>
    <?php include(__DIR__ . '/footer.php');?>
  </body>
</html>