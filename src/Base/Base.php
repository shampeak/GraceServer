<?php

namespace Grace\Base;

class Base extends Set
{
    /*
     |--------------------------------------------------------------------------
     | $_config存储配置数据,用于反射
     |--------------------------------------------------------------------------
     | 在construct中执行$this->_config = $config;
     |
     */
    private $_config = array();

    public function __construct($config = array())
    {
        $this->_config = $config;
    }

    /*
    |--------------------------------------------------------------------------
    | 通用 : 返回所有的方法
    |--------------------------------------------------------------------------
    */
    public function actions()
    {
        $flag = [
            'actions',
            '__construct',
            '__toString',
            '__invoke',
            '__call',
            'offsetExists',
            'offsetGet',
            'offsetSet',
            'offsetUnset',
            '__get',
            '__set',
            '__isset',
            '__unset',
            'normalizeKey',
            'set',
            'get',
            'replace',
            'has',
            'remove',
            'getIterator',
        ];

        return [
            'classname' => get_class($this),
            'methods' => array_diff(get_class_methods($this), $flag),
            '_methods' => array_intersect(get_class_methods($this), $flag),
            '_sys' => array_intersect(get_class_methods($this), [
                'actions',
                'clear',
                'count',
                'all',
                'keys',
                'load'
            ]),
            '_config' => $class_vars = get_class_vars(get_class($this)),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | 通用 : 返回简单的名称和说明
    | 被集成后进行重写
    |--------------------------------------------------------------------------
    |
    */
    function __toString()
    {
        return 'toString';
    }

    /*
    |--------------------------------------------------------------------------
    | 通用 : 返回配置信息
    |--------------------------------------------------------------------------
    | 返回所有值,或者返回某一个值
    |
    */
    function __invoke($key = [])
    {
        if (is_string($key)) {
            return $this->_config[$key];
        } else {
            return $this->_config;
        }
    }

}
