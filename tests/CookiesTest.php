<?php


class StackTest extends PHPUnit_Framework_TestCase
{
    public function testPushAndPop()
    {

        $config = [
            'prefix'   => 'GraceEasy',                                             // cookie prefix ǰ׺
            'securekey'=> 'ekOt4_Ut0f3XE-fJcpBvRFrg506jpcuJeixezgPNyALm',     // encrypt key   ��Կ
            'expire'   => 36000,     //��ʱʱ��
        ];
        // Arrange
        $res = new Grace\Cookies\Cookies($config);

    }
}