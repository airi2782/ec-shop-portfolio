<?php
// 名前空間は MyApp
// index.php の controller のクラスは
// MyApp\Controller\Index
// そのクラスをインスタンス化する場合は
// lib/Controller/Index.php
// というディレクトリーをrequireする

spl_autoload_register(function($class){
  $prefix = 'MyApp\\';
  if(strpos($class,$prefix) === 0){
    $class_name = substr($class,strlen($prefix));
    $class_file_path = 
    __DIR__ . '/../lib/' . str_replace('\\','/',$class_name) . '.php';
    if(file_exists($class_file_path)){
      require $class_file_path;
    }
  }
});