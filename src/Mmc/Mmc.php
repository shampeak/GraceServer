<?php

namespace Grace\Mmc;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/4 0004
 * Time: 16:37
 */

class Mmc {


      public      $group      = '';
      private     $mmc        = NULL;
      private     $ver        = 0;
      private     $_config    = array();

      public function __construct($memConfig = array()) {
            $this->_config = $memConfig;
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            $this->mmc = new \Memcache();
            if(empty($memConfig)) {
                  $memConfig['MEM_SERVER'] = [
                      ['127.0.0.1', 11211]
                  ];
                  $memConfig['MEM_GROUP'] = 'default';
            }
            //实现addServer功能
            foreach($memConfig['MEM_SERVER'] as $config) {
                  /*
                  *先将$memConfig['MEM_SERVER']中的服务器信息遍历出来，服务器信息在配置文件中设置，
                  属于array('127.0.0.1', 11211)、	array('127.0.0.2', 11211)....
                  *这种类型，然后调用call_user_func_array()函数，该函数的作用,举一个例子说明：
                  *当array('127.0.0.1', 11211)时，即call_user_func_array(array($this->mmc, 'addServer'), $config);时是理解为
                  *$this->mmc->addServer('127.0.0.1',11211),因为call_user_func_array函数也可以调用类内部的方法的,$config中的元素，对应
                  *成为addServer方法的参数
                  */
                  call_user_func_array(array($this->mmc, 'addServer'), $config);
            }
            $this->group = $memConfig['MEM_GROUP'];
            $this->ver = intval( $this->mmc->get($this->group.'_ver') );
      }

      //获得memcache的版本信息
      public function version(){
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            return $this->mmc->getVersion();

      }

      //读取缓存
      public function get($key) {
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            return $this->mmc->get($this->group.'_'.$this->ver.'_'.$key);
      }

      //设置缓存
      public function set($key,$value,$expire = 1800) {
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            return $this->mmc->set($this->group.'_'.$this->ver.'_'.$key, $value, 0,$expire);
      }

      public function has($key)
      {
            if(!$this->_config['MEM_ENABLE']) return null;
            $data = $this->mmc->get($this->group.'_'.$this->ver.'_'.$key);
            if (!$data) {
                  return false;
            }
            return true;
      }


      //添加缓存
      public function add($key, $value, $expire = 1800) {
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            if(!$this->get($key)){
                  return $this->mmc->add($this->group.'_'.$this->ver.'_'.$key, $value,0,$expire);
            }else{
                  echo "设置失败，该键值被已被注册";
                  return false;
            }
      }

      //替换缓存
      public function replace($key, $value, $expire = 1800){
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            return $this->mmc->replace($this->group.'_'.$this->ver."_".$key,0, $value);
      }

      //自增1
      public function inc($key, $value = 1) {
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            return $this->mmc->increment($this->group.'_'.$this->ver.'_'.$key, $value);
      }

      //自减1
      public function des($key, $value = 1) {
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            return $this->mmc->decrement($this->group.'_'.$this->ver.'_'.$key, $value);
      }

      //删除
      public function del($key) {
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            return $this->mmc->delete($this->group.'_'.$this->ver.'_'.$key);
      }

      //全部清空
      public function clear() {
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            $this->ver = $this->ver + 1;
            return  $this->mmc->set($this->group.'_ver', $this->ver);
      }

      //关闭缓存
      public function close() {
            if(!$this->_config['MEM_ENABLE']) return null;
            // | ------------------------------------------------------
            return $this->mmc->close();
      }



}


