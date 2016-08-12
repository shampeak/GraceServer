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
        return \Grace\Server\Server::getInstance('../Config/');
    }
    return \Grace\Server\Server::getInstance('../Config/')->make($make, $parameters);
}







//====================================================
//xls
server('xls')->read(__DIR__.'/test.xls');
print_r(server('xls')->sheets);
//====================================================
exit;
