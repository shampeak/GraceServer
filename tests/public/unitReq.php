<?php
include("../vendor/autoload.php");

//错误提示
$error_reporting       = E_ALL ^ E_NOTICE;
ini_set('error_reporting', $error_reporting);
//error_reporting(0);

echo 'Hello Grace\Db\Db';



//    function channel($channel,$args = 0,$key = '', $value = array())
//    {
//        return Grace\Wise\Wise::getInstance()->channel($channel)->C($args,$key, $value);
//    }
//
////    //request 配置
//    function req($key = '', $value = array())    {
//        return channel('req',func_num_args(),$key,$value);
//    }



$res = new Grace\Req\Req();

echo '<pre>';

print_r($res->env);
print_r($res->path);
print_r($res->query);
print_r($res->getquery);
print_r($res->getpath);
print_r($res->get);
print_r($res->post);
echo '</pre>';
