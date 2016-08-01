<?php
include("../vendor/autoload.php");

//错误提示
$error_reporting       = E_ALL ^ E_NOTICE;
ini_set('error_reporting', $error_reporting);
//error_reporting(0);

echo 'Hello Grace\Base\Base';



class Test extends \Grace\Base\Base
{
    public function Run()
    {
        echo 123;
    }
}

$test = new Test();

$test->Run();
