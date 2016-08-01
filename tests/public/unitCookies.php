<?php
include("../vendor/autoload.php");
define('APPROOT', '../App/');

//错误提示
$error_reporting       = E_ALL ^ E_NOTICE;
ini_set('error_reporting', $error_reporting);
//error_reporting(0);

$config =  [

    'prefix'   => 'GraceEasy',                                             // cookie prefix 前缀
    'securekey'=> 'ekOt4_Ut0f3XE-fJcpBvRFrg506jpcuJeixezgPNyALm',     // encrypt key   密钥
    'expire'   => 36000,     //超时时间

];

$res = new Grace\Cookies\Cookies($config);
//print_r($res);

/**
 * 设置 / 读取
 */
//$res->set("name","irones",100);
//$res->clear("name");
//$name = $res->get("name");
//print_r($name);

