<?php
// ini_set('display_errors',1);

// require dirname(__FILE__).'/../../vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../..');
// $dotenv->load();

// define('DSN','mysql:host='.$_ENV['HOST'].';
// dbname='.$_ENV['MYSQL_DATABASE']);
// define('DB_USERNAME',$_ENV['DB_USERNAME']);
// define('DB_PASSWORD',$_ENV['MYSQL_ROOT_PASSWORD']);

define('DSN','mysql:host=db;
dbname=ec_shop_test');
define('DB_USERNAME','root');
define('DB_PASSWORD','27822750');

define('SITE_URL','http://'.$_SERVER['HTTP_HOST']);

define('ITEM_PER_PAGE',8);

require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/autoload.php');

session_start();