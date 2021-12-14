<?php
ini_set('display_errors',0);

// require dirname(__FILE__).'/../../vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../..');
// $dotenv->load();

// define('DSN','mysql:host='.$_ENV['HOST'].';
// dbname='.$_ENV['MYSQL_DATABASE']);
// define('DB_USERNAME',$_ENV['DB_USERNAME']);
// define('DB_PASSWORD',$_ENV['MYSQL_ROOT_PASSWORD']);

// define('DSN','mysql:host=db;
// dbname=ec_shop_test');
// define('DB_USERNAME','root');
// define('DB_PASSWORD','27822750');

define('DSN','mysql:host=yjo6uubt3u5c16az.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;
dbname=irjp5et7y53tr79a');
define('DB_USERNAME','j7uau7aqorfidfm3');
define('DB_PASSWORD','gsl5irq6xxfae8a7');

define('SITE_URL','http://'.$_SERVER['HTTP_HOST']);

define('ITEM_PER_PAGE',8);

require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/autoload.php');

session_start();