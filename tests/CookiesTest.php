<?php


class StackTest extends PHPUnit_Framework_TestCase
{
    public function testPushAndPop()
    {

        $config = [
            'prefix'   => 'GraceEasy',                                             // cookie prefix 前缀
            'securekey'=> 'ekOt4_Ut0f3XE-fJcpBvRFrg506jpcuJeixezgPNyALm',     // encrypt key   密钥
            'expire'   => 36000,     //超时时间
        ];
        // Arrange
        $res = new Grace\Cookies\Cookies($config);

    }
}