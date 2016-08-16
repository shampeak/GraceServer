<?php

namespace Grace\Parsedown;

class Parsedown
{
    private $_instance = null;
    private $_Config = null;

    /**
     * Parsedown constructor.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_Config = $config;
        $this->_instance = new \Parsedown();
    }

    /**
     * @param $text
     *
     * @return string
     */
    function text($text)
    {
        return $this->_instance->text($text);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->_instance->$key;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function __set($key, $value)
    {
        return $this->_instance->$key = $value;
    }

    //脚手架
    /**
     *
     */
    public function test()
    {
        //do something
    }


}
