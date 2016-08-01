<?php
include("../vendor/autoload.php");

//错误提示
$error_reporting       = E_ALL ^ E_NOTICE;
ini_set('error_reporting', $error_reporting);
//error_reporting(0);

echo 'Hello Grace\Base\Base';



$config =  [
    'viewpath'   => '../Config/View/',
];

$res = new Grace\View\View($config);

$res->viewpath('../Config/View/');      //改变模板根路径
//指定控制器和执行方法
//$res->router([
//    'Controller'=>'controller',
//    'Mothed'    =>'mothed',
//]);

//$res->assign("name","irones");


$res->display('index',[
    "name"=>'shampeak'
]);
exit;

var_dump($res);