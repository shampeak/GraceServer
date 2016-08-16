<?php

namespace Grace\Req;

use Grace\Base\Base;

class Req extends Base
{

    private $_config = array();

    /**
     * Req constructor.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_config = $config;
    }

    /**
     * @param string $key
     *
     * @return array
     */
    public function __get($key = '')
    {

        switch ($key) {
            case 'env':
                return \Grace\Req\Environment::getInstance()->all();
                break;
            case 'path':            //env 元数据
                return \Grace\Req\Environment::getInstance()->all()['path'];
                break;
            case 'query':           //env 元数据
                return \Grace\Req\Environment::getInstance()->all()['query'];
                break;
            case 'getquery':        //query jx
                return $this->getquery();
                break;
            case 'getpath':         //pathjx
                return $this->getpath();
                break;
            case 'get':             //get mix
                return $this->_get();
                break;
            case 'post':            //post
                return $_POST;
                break;
        }
    }

    /**
     * @return mixed
     */
    public function _get()
    {

        $res = array_merge($this->getpath(), $this->getquery());
        $res = array_merge($res, $_GET);
        // unset($res['params']);
        return $res;
    }


    /**
     * @return array
     */
    public function getpath()
    {
        $path = \Grace\Req\Environment::getInstance()->all()['path'];
        $path = trim($path, '/');

        $_path = explode('/', $path);
        foreach ($_path as $k => $value) {
            if (empty($value)) {
                unset($_path[$k]);
            }
        }
        reset($_path);
        if (current($_path) == 'index.php') {
            array_shift($_path);
        }
        $_params = array();
        $_params['params'] = '';
        $_params['c'] = array_shift($_path);            //控制器
        $_params['a'] = array_shift($_path);            //方法
        if (count($_path) == 1) {
            $_params['params'] = array_shift($_path);            //方法
            array_shift($_path);
        } else {
            //==============================================
            $count = ceil(count($_path) / 2);
            for ($i = 0; $i < $count; $i++) {
                $ii = $i * 2;
                isset($_path[$ii + 1]) && $_params[$_path[$ii]] = $_path[$ii + 1];
            }
            //==============================================
        }
        return $_params;
    }

    /**
     * @return array
     */
    public function getquery()
    {
        $query = \Grace\Req\Environment::getInstance()->all()['query'];
        $_p = array();
        $_query = explode('&', $query);
        foreach ($_query as $k => $value) {
            //存在=号
            $p = explode('=', $value);
            if (!empty($p[0])) {
                $_p[$p[0]] = isset($p[1]) ? $p[1] : '';
            }
        }
        return $_p;       //获得通过querystring 分析出来的参数
    }

    //=============================================
    //Property Overloading
    //=============================================

    /**
     *
     */
    public function test()
    {
        //do something
    }


}
