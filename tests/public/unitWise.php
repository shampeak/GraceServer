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



Grace\Wise\Wise::getInstance()->channel('bus')->C(1,[
    'name'  => "irones",
    "title" => "title123"
]);

$res = Grace\Wise\Wise::getInstance()->channel('bus')->C(1,"name");


print_r($res);