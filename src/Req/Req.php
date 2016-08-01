<?php

namespace Grace\Req;

use Grace\Base\Base;

/*
 *      //$req = app('req')->env;
        $req = app('req')->path;
        $req = app('req')->query;
        $req = app('req')->getquery;    //根据query 解析
        //$req = app('req')->getpath;     //根据path 解析
        $req = app('req')->get;         //mix 之后的ge数据
        $req = app('req')->post;
 */

class Req extends Base
{

      /*
       * 获得重要的两个值 get post
       * $req->get
       * $req->post
      |--------------------------------------------------------------------------
      | request 获取
      |--------------------------------------------------------------------------
      | 对于get 是一个参数传递的集合 包括以下几个部分
      1 : $_GET
      2 : getpath
      3 : getpathparams
      4 : getquery
      5 : querystring
      6 : params
      |
      */
      private $_config  = array();

//      public $get       = array();
//      public $post      = array();

      // *-----------------------------------------------------------------
      public function __construct($config = array()){
            $this->_config = $config;
      }

      /*
       * env
       * _path
       * path
       * _query
       * post
       * _get     根据path和query获取到的get数据
       * get      get数据mix
       * */
      public function __get($key='')
      {

            switch($key){
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

      /*
      |-----------------------------------------------------------------
      | 综合输出 mix query path $_get
      |-----------------------------------------------------------------
       *
       */
      public function _get()
      {

            $res = array_merge($this->getpath(),$this->getquery());
            $res = array_merge($res,$_GET);
           // unset($res['params']);
            return $res;
      }


      //根据path传递的参数
      public function getpath()
      {
            $path = \Grace\Req\Environment::getInstance()->all()['path'];
            $path = trim($path,'/');

            $_path = explode('/', $path);
            foreach($_path as $k=>$value){
                  if(empty($value)) unset($_path[$k]);
            }
            reset($_path);
            if(current($_path) == 'index.php'){
                  array_shift($_path);
            }
            $_params = array();
            $_params['params'] = '';
            $_params['c'] = array_shift($_path);            //控制器
            $_params['a'] = array_shift($_path);            //方法
            if(count($_path) ==1){
                  $_params['params'] = array_shift($_path);            //方法
                  array_shift($_path);
            }else{
                  //==============================================
                  $count = ceil(count($_path) / 2);
                  for ($i = 0; $i < $count; $i++) {
                        $ii = $i * 2;
                        isset($_path[$ii + 1]) && $_params[$_path[$ii]] = $_path[$ii + 1] ;
                  }
                  //==============================================
            }
            return $_params;
      }

      //根据query string分析传递的参数
      public function getquery()
      {
            $query = \Grace\Req\Environment::getInstance()->all()['query'];
            $_p = array();
            $_query = explode('&', $query);
            foreach($_query as $k=>$value){
                  //存在=号
                  $p = explode('=', $value);
                  if(!empty($p[0])){
                        $_p[$p[0]] = isset($p[1])?$p[1]:'';
                  }
            }
            return $_p;       //获得通过querystring 分析出来的参数
      }



}
