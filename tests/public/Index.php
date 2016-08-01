<?php
include("../vendor/autoload.php");
define('APPROOT', '../App/');

//错误提示
$error_reporting       = E_ALL ^ E_NOTICE;
ini_set('error_reporting', $error_reporting);
//error_reporting(0);

function server($make = null, $parameters = [])
{
    if (is_null($make)) {
        return Grace\Server\Server::getInstance('../Config/');
    }
    return Grace\Server\Server::getInstance('../Config/')->make($make, $parameters);
}


////1 创建，然后制定
////$server = Grace\Server\Server::getInstance();       //创建对象
////$server = Grace\Server\Server::getInstance()->ConfigRoot('../Docs/Config/');        //指定配置目录
////2 创建制定
//$server = Grace\Server\Server::getInstance('../Config/');       //创建对象
////var_dump($server);
////exit;
//
////返回配置信息
//$server = Grace\Server\Server::getInstance()->Config('Db');
//$server = Grace\Server\Server::getInstance()->Config('Config');
////$server = Grace\Server\Server::getInstance()->Config('Application');
//var_dump($server);
//exit;


$res = server('db')->getall("select * from dy_user");
print_r($res);

//按照配置创建其他对象


