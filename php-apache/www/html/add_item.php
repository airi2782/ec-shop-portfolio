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

<form action = "index.php" method = "POST">
  <label>カテゴリー<input type = "radio" name = "item_category" value = 1>バレッタ</label>
  <label><input type = "radio" name = "item_category" value = 2>イヤリング</label>
  <label><input type = "radio" name = "item_category" value = 3>ピアス</label>
  <br>
  <label>花の種類<input type = "radio" name = "flower_type" value = 1>かすみ草</label>
  <label><input type = "radio" name = "flower_type" value = 2>アリッサム</label>
  <label><input type = "radio" name = "flower_type" value = 3>ダリア</label>
  <label><input type = "radio" name = "flower_type" value = 4>ローズ</label>
  <label><input type = "radio" name = "flower_type" value = 5>ボタン</label>

  <p>商品名<input type = "text" name = "item_name"></p>
  <p>値段<input type = "text" name = "price">円</p>
  <p>在庫<input type = "text" name = "stock">個</p>
  <p>説明<textarea rows="4" name = "description"></textarea></p>
  <p>写真１<input type = "text" name = "img1"></p>
  <p>写真２<input type = "text" name = "img2"></p>
  <p>写真３<input type = "text" name = "img3"></p>
  <p>写真４<input type = "text" name = "img4"></p>

  <input type = "submit" value = "商品を追加する">
  <input type = "hidden" value = "<?=h($_SESSION['token'])?>">
</form>



</body>
</html>