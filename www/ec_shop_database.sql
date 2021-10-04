-- テーブル追加
--性別
create table genders(
  gender_id int auto_increment not null,
  gender_name varchar(20),
  created_at datetime,
  updated_at datetime,
  primary key (gender_id)
);

--支払い方法
create table payments(
  payment_id int auto_increment not null,
  payment_name varchar(32),
  created_at datetime,
  updated_at datetime,
  primary key (payment_id)
);

--ユーザー
create table users (
  user_id int auto_increment  not null,
  user_name varchar(32) not null,
  gender_id int not null,
  email varchar(255) unique not null,
  password varchar(255) not null,
  phone_num varchar(11) not null,
  address varchar(255) not null,
  payment_id int not null,
  created_at datetime,
  updated_at datetime,
  primary key (user_id),
  constraint fk_gender_id
    foreign key (gender_id)
    references genders (gender_id)
    on delete restrict on update restrict,
  constraint fk_payment_id
    foreign key (payment_id)
    references payments (payment_id)
    on delete restrict on update restrict
);

--商品
create table items (
  item_id int auto_increment  not null,
  item_category_id int not null,
  flower_type_id int not null,
  item_name varchar(32) not null,
  price int not null,
  stock int not null,
  description text not null,
  img1 varchar(255),
  img2 varchar(255),
  img3 varchar(255),
  img4 varchar(255),
  created_at datetime,
  updated_at datetime,
  primary key (item_id),
  constraint fk_item_category_id
    foreign key (item_category_id)
    references item_categories (item_category_id)
    on delete restrict on update restrict,
  constraint fk_flower_type_id
    foreign key (flower_type_id)
    references flower_types (flower_type_id)
    on delete restrict on update restrict
);

--お店
create table shops (
  shop_id int auto_increment not null,
  shop_name varchar(32) not null,
  email varchar(255) unique not null,
  password varchar(255) not null,
  created_at datetime,
  updated_at datetime,
  primary key (shop_id)
);

--商品カテゴリー
create table item_categories (
  item_category_id int auto_increment not null,
  item_category_name varchar(32) not null,
  created_at datetime,
  updated_at datetime,
  primary key (item_category_id)
);

--花の種類
create table flower_types (
  flower_type_id int auto_increment not null,
  flower_type_name varchar(32),
  created_at datetime,
  updated_at datetime,
  primary key (flower_type_id)
);

--お気に入り
create table favorites (
  favorite_id int auto_increment not null,
  item_id int unique,
  user_id int not null,
  created_at datetime,
  updated_at datetime,
  primary key (favorite_id),
  constraint fk_item_id
    foreign key (item_id)
    references items (item_id)
    on delete restrict on update restrict,
  constraint fk2_user_id
    foreign key (user_id)
    references users (user_id)
    on delete restrict on update restrict
);

--カート
create table carts (
  cart_id int auto_increment not null,
  item_id int unique,
  user_id int not null,
  cart_qty int,
  created_at datetime,
  updated_at datetime,
  primary key (cart_id),
  constraint fk2_item_id
    foreign key (item_id)
    references items (item_id)
    on delete restrict on update restrict,
  constraint fk3_user_id
    foreign key (user_id)
    references users (user_id)
    on delete restrict on update restrict
);

--カート（未ログイン時）
create table no_login_carts (
  no_login_cart_id int auto_increment not null,
  item_id int unique,
  cart_qty int,
  created_at datetime,
  updated_at datetime,
  primary key (no_login_cart_id),
  constraint fk4_item_id
    foreign key (item_id)
    references items (item_id)
    on delete restrict on update restrict
);

--購入履歴
create table purchase_histories (
  purchase_history_id int auto_increment not null,
  user_id int,
  total_price int not null,
  created_at datetime,
  updated_at datetime,
  primary key (purchase_history_id),
  constraint fk_user_id
    foreign key (user_id)
    references users (user_id)
    on delete restrict on update restrict
);

--購入明細
create table purchase_detail_histories (
  purchase_history_id int not null,
  item_id int,
  purchase_qty int,
  primary key (purchase_history_id,item_id),
  constraint fk_purchase_history_id
    foreign key (purchase_history_id)
    references purchase_histories (purchase_history_id)
    on delete restrict on update restrict,
  constraint fk3_item_id
    foreign key (item_id)
    references items (item_id)
    on delete restrict on update restrict  
);


-- 値追加

--お店
insert into shops 
(shop_id,shop_name,email,password,created_at,updated_at)
value(1,'ec_shop1','test@gmail.com',1111,now(),now());

--性別
insert into genders
(gender_id,gender_name,created_at,updated_at)
value(1,'男性',now(),now()),
(2,'女性',now(),now()),
(3,'その他',now(),now());

--支払い方法
insert into payments
(payment_id,payment_name,created_at,updated_at)
value(1,'クレジットカード',now(),now()),
(2,'銀行振込',now(),now()),
(3,'後払い',now(),now()),
(4,'代金引換',now(),now());

--商品カテゴリー
insert into item_categories
(item_category_id,item_category_name,created_at,updated_at)
value(1,'baletta',now(),now()),
(2,'earring',now(),now()),
(3,'pierce',now(),now());

--花の種類
insert into flower_types
(flower_type_id,flower_type_name,created_at,updated_at)
value(1,'kasumi_grass',now(),now()),
(2,'alyssum',now(),now()),
(3,'dahlia',now(),now()),
(4,'rose',now(),now()),
(5,'peony',now(),now());

--商品
insert into items
(item_id,item_category_id,flower_type_id,item_name,price,stock,description,img1,img2,img3,img4,created_at,updated_at)
value(1,1,1,'かすみ草パールバレッタ',1300,2,
'本物のかすみ草をたっぷりレジンに閉じ込めたバレッタです.｡*ﾟ+.*.｡
歩く度に光を受けてつやつやに輝きます゜:。* ゜.
ナチュラルかつ上品なデザインとなっておりますので
パーティー・普段使い・お出かけなど、活躍する場所を選びません。
お洒落のポイントに是非♥',
'/pic/item1/img1.png','/pic/item1/img2.png','pic/item1/img3.png','pic/item1/img4.png',now(),now()),

(2,2,1,'かすみ草パールイヤリング',700,3,
'たっぷりレジンを使って本物のかすみ草を閉じ込め、パールと合わせてみました゜:。* ゜.
シンプルかつ可愛く、上品なデザインとなっております。
パーティー、デート、普段使いなど活躍の場を選びません。
お洒落のワンポイントとしてぜひ｡・:＋°',
'/pic/item2/img1.png','/pic/item2/img2.png','/pic/item2/img3.png','/pic/item2/img4.png',now(),now()),

(3,1,1,'かすみ草パールバレッタ【winter ver.】',1200,2,
'本物のかすみ草とパールをレジンに閉じ込めたバレッタです。
パールを雪に見立て、レジンに淡いお色を加えることで
冬らしくかつ温かみのある作品に仕上げました｡・:＋°
これからの季節にぴったりですので、普段使いはもちろん、デートや特別な日にも是非♥',
'/pic/item3/img1.png','/pic/item3/img2.png','pic/item3/img3.png','/pic/item3/img4.png',now(),now()),

(4,3,3,'くすみフラワーイヤリング',1600,1,
'くすみカラーのフラワーモチーフと冬らしいコットンパールを合わせたイヤリング･.｡*･.｡*
程よいボリュームのパールたちが、歩く度に貴方の耳元を輝かせてくれます。
上品で綺麗めなデザインですので、普段使いやデートはもちろん、結婚式やパーティ等でもお使いいただけます｡・:＋°',
'/pic/item4/img1.png','/pic/item4/img2.png','/pic/item4/img3.png','/pic/item4/img4.png',now(),now()),

(5,3,1,'かすみ草デルタピアス',800,1,
'シンプルなかすみ草だけのピアス/イヤリング･.｡*･.｡*
レジンをたっぷり塗り重ね、つやつやに仕上げました。
こちらはデルタ型になります。△
耳元からさりげなく覗くかすみ草がとても可愛いです｡・:＋°',
'/pic/item5/img1.png','/pic/item5/img2.png','/pic/item5/img3.png','/pic/item5/img4.png',now(),now()),

(6,2,5,'華やぐボタンイヤリング',2000,2,
'くすみカラーのボタンとタッセルを合わせたイヤリング･.｡*･.｡*
大きめフラワーで可愛らしさ、タッセルで大人っぽさを表現してみました。
シンプルな服装に合わせてお洒落のワンポインに♥',
'pic/item6/img1.png','/pic/item6/img2.png','/pic/item6/img3.png','/pic/item6/img4.png',now(),now()),

(7,3,4,'ミニバラダイヤ型ピアス',1200,3,
'本物のミニバラをそのまま使ったイヤリングです。
ミニバラをまるごと使っているので立体感があり、
まるで額縁から抜け出た絵画のよう･.｡*･.｡*
デートやお出かけ、特別な日にも◎｡・:＋°',
'pic/item7/img1.png','/pic/item7/img2.png','/pic/item7/img3.png','/pic/item7/img4.png',now(),now()),

(8,2,1,'かすみ草ふんわりパールイヤリング',1000,2,
'本物のかすみ草をたっぷりのレジンに閉じ込めたイヤリングです｡・:＋°
ふんわりとしたお色加え、やわらかく暖かみのあるデザインに仕上げました。
大きめパールがとってもよく合います。
普段使いはもちろん、デートやパーティなどの特別な日にも♥',
'pic/item8/img1.png','/pic/item8/img2.png','/pic/item8/img3.png','/pic/item8/img4.png',now(),now()),

(9,2,3,'くすみフラワードロップイヤリング【DustyPink】',1800,1,
'くすみカラーのお花とドロップのような天然石を合わせたイヤリング･.｡*･.｡*
大きめ天然石とスクエアリングが歩く度に揺れて貴方の耳元を輝かせてくれます。
普段使いはもちろん、結婚式やパーティ・デートにも♥',
'pic/item9/img1.png','/pic/item9/img2.png','/pic/item9/img3.png','/pic/item9/img4.png',now(),now()),

(10,2,1,'かすみ草クリアシュガーイヤリング',1000,2,
'本物のかすみ草を使用したイヤリング･.｡*･.｡*
クリアなビーズが歩くたびにゆらゆらキラキラと輝きます。
夏らしい涼しげで上品なデザインとなっております。
普段使いはもちろん、デートやパーティ等の特別な機会にも是非｡・:＋°',
'pic/item10/img1.png','/pic/item10/img2.png','/pic/item10/img3.png','/pic/item10/img4.png',now(),now()),

(11,1,1,'ビオラとかすみ草のバレッタ',1300,1,
'本物のビオラとかすみ草をレジンで閉じ込めたバレッタです･.｡*･.｡*
ブルーのクリアビーズと合わせて、爽やかで夏らしいデザインにしてみました。
さっと付けるだけで、髪の毛を華やかにスタイルアップしてくれます♥
お出かけやデート、パーティなど活躍の場を問いません。
一点物ですので、気になっている方は是非お早めに｡˚✩',
'pic/item11/img1.png','/pic/item11/img2.png','/pic/item11/img3.png','/pic/item11/img4.png',now(),now()),

(12,3,1,'春待つ蕾ピアス',700,3,'かすみ草の蕾をたっぷりのレジンに閉じ込めたピアス/イヤリング｡・:＋°
シンプルなデザインですので、どんな時にでもつけていただけます。',
'pic/item12/img1.png','/pic/item12/img2.png','/pic/item12/img3.png','/pic/item12/img4.png',now(),now()),

(13,2,1,'かすみ草標本イヤリング',900,2,
'たっぷりのレジンに本物のかすみ草を閉じ込めたイヤリング･.｡*･.｡*
小さなパールがよく合います♥
クリアでつやつやなイヤリングですので、これからの季節にもぴったりです。
シンプルで上品なデザインですので、普段使いはもちろん、パーティやお出かけなどの特別な日にも是非｡・:＋°',
'pic/item13/img1.png','/pic/item13/img2.png','/pic/item13/img3.png','/pic/item13/img4.png',now(),now()),

(14,3,2,'ダイヤアリッサム ピアス【RosePink】',950,3,
'ダイヤ型にアリッサムと金箔を閉じ込めたピアス/イヤリング･.｡*･.｡*
シンプルながらも女性らしさ、上品さのあるデザインです。
普段使いはもちろん、パーティやデートなど特別な時間にも♥',
'pic/item14/img1.png','/pic/item14/img2.png','/pic/item14/img3.png','/pic/item14/img4.png',now(),now()),

(15,2,3,'くすみフラワードロップイヤリング【Salmon Pink】',1800,1,
'くすみカラーのお花とドロップのようなラウンドビーズを合わせたイヤリング/ピアス･.｡*･.｡*
つやつやドロップとリングが歩く度に揺れて貴方の耳元を輝かせてくれます。
普段使いはもちろん、結婚式やパーティ・デートにも♥',
'pic/item15/img1.png','/pic/item15/img2.png','/pic/item15/img3.png','/pic/item15/img4.png',now(),now()),

(16,1,1,'かすみ草 パールバレッタ 【3 shape】',1300,1,
'本物のかすみ草をたっぷり使ったアクセサリー･.｡*･.｡*
ラウンド デルタ スクエアの3種類の形をしたパーツを使用しました。
クリアで涼しげかつ上品なイメージのバレッタです。
普段使いはもちろん、デートやパーティ等の特別な機会にも｡・:＋°',
'pic/item16/img1.png','/pic/item16/img2.png','/pic/item16/img3.png','/pic/item16/img4.png',now(),now()),

(17,2,5,'華やぐ ボタンとべっ甲風ドロップのイヤリング',1600,1,
'スモークサーモンピンクのボタンモチーフにべっ甲風ビーズとリングを合わせたイヤリング･.｡*･.｡*
べっ甲風ドロップが秋らしく揺れて、貴方の耳元を華やかにしてくれます。
普段使いは勿論、デートやパーティなどにも是非｡・:＋°',
'pic/item17/img1.png','/pic/item17/img2.png','/pic/item17/img3.png','/pic/item17/img4.png',now(),now()),

(18,2,3,'ダリアとべっ甲風ドロップのイヤリング',1000,1,
'ブラウンのフラワーモチーフとべっ甲風ビーズのイヤリング。
ブラウンでまとめましたので、秋冬にほっこり大人可愛く使っていただけます。
歩く度にべっ甲風ドロップがゆらゆら揺れて可愛いです。
普段使いは勿論、デートやお出かけなどにも是非･.｡*･.｡*',
'pic/item18/img1.png','/pic/item18/img2.png','/pic/item18/img3.png','/pic/item18/img4.png',now(),now()),

(19,3,3,'ダリアとミルクティドロップのピアス',950,1,
'スモークピンクのフラワーモチーフとミルクティ色のドロップのようなビーズを使ったピアス。
秋冬らしいお色で、ほっこり可愛く使っていただけます。
普段使いは勿論、デートやお出かけなどにも是非･.｡*･.｡*',
'pic/item19/img1.png','/pic/item19/img2.png','/pic/item19/img3.png','/pic/item19/img4.png',now(),now());








