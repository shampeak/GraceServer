<?php

namespace Grace\Parsedown;

class Parsedown
{
      private $_instance     = null;
      private $_Config  = null;

      public function __construct($config = array()){
            $this->_Config    = $config;
            $this->_instance = new \Parsedown();
      }

      function text($text)
      {
            return $this->_instance->text($text);
      }

      //=============================================
      //Property Overloading
      //=============================================

      public function __get($key)
      {
            return $this->_instance->$key;
      }

      public function __set($key, $value)
      {
            return $this->_instance->$key = $value;
      }



      //=============================================
      //Property Overloading
      //=============================================

      //脚手架
      public function test()
      {
            //do something
      }

      //页面
      public function help()
      {
            //获取显示模板
            $tpl = \Grace\Base\Help::getpl();

            //获取内容解析
            $nr = $this->helpnr();
            $html = str_replace('##nr##',$nr,$tpl);
            echo $html;
            exit;
      }

      //内容
      public function helpnr()
      {
            return (new \Parsedown())->text(file_get_contents(__DIR__."/readme.md"));
      }



}
