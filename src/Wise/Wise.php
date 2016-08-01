<?php

namespace Grace\Wise;

use Grace\Base\Set;
/*
 * Class wise
 * @package Sham\wise
 */

class Wise extends Set
{
      private static $_instance = null;       //单例调用
      public $_config  = array();              //C函数的存储
      private $channel = '';

      /*
       * @param string $conf
       * 根据配置获取设定
       */
      private function __construct(){
            $this->channel('config')->C();
      }

      /*
       * @param $conf
       * @return wise|null
       * 单例调用
       */
      public static function getInstance(){
            if(!(self::$_instance instanceof self)){
                  self::$_instance = new self();
            }
            return self::$_instance;
      }

      public function channel($channel = '')
      {
            $this->channel = $channel;
            return $this;
      }

      public function C($args = 0, $key = '', $value = array()){
            !isset($this->_config[$this->channel]) && $this->_config[$this->channel] = [];
            switch($args){
                  //1 : 返回配置信息
                  case 0:
                        return $this->_config[$this->channel];
                        break;

                  //2 : 有一个参数
                  case 1:
                        if (is_string($key)) {  //如果传入的key是字符串
                              return isset($this->_config[$this->channel][$key]) ? $this->_config[$this->channel][$key] : null;
                        }
                        if (is_array($key)) {
                              if (array_keys($key) !== range(0, count($key) - 1)) {  //如果传入的key是关联数组
                                   $this->_config[$this->channel] = $this->_config[$this->channel]? array_merge($this->_config[$this->channel], $key):$key;
                              } else {
                                    $ret = array();
                                    foreach ($key as $k) {
                                          $ret[$k] = isset($this->_config[$this->channel][$k]) ? $this->_config[$this->channel][$k] : null;
                                    }
                                    return $ret;
                              }
                        }
                        break;
                  default:
                        //设置一个值
                        if (is_string($key)) {
                              $this->_config[$this->channel][$key] = $value;
                        }
            }
            return null;
      }

      /*
       * @param $key
       * @return null
       * 调用其中的数据
       */
      function __invoke($key = null) {
            $res = $key?$this->_config[$key]:$this->_config;
            return $res;
      }

}
