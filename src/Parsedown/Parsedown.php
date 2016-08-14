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



}
