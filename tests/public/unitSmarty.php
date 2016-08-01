<?php
include("../vendor/autoload.php");

//错误提示
$error_reporting       = E_ALL ^ E_NOTICE;
ini_set('error_reporting', $error_reporting);
//error_reporting(0);

echo 'Hello Grace\Base\Base';



$config =  [
    'TemplateDir'   => '../Config/View/',
    'ConfigDir'     => 'Views/SmartyConfigs/',
    'CompileDir'    => 'Cache/SmartyTemplates_c/',
    'CacheDir'      => 'Cache/SmartyCache/',
    'debugging'     => false,
    'caching'       => false,
    'cache_lifetime'=> 1
];

$res = new Grace\Smarty\Smarty($config);

$res->path('../Config/View/');      //改变模板根路径
$res->router([
    "Controller"=>"Home",
    "Mothed"    =>"Index",
    "Params"    =>"Ext",
]);

$res->display('index2');


var_dump($res);

//指定控制器和执行方法
//$res->router([
//    'Controller'=>'controller',
//    'Mothed'    =>'mothed',
//]);

//$res->assign("name","irones");

//
//$res->display('index',[
//    "name"=>'shampeak'
//]);
exit;

var_dump($res);