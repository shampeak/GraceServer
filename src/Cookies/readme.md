## Grace\Cookie
> Cookie的设置读取


### 配置

> 这个是文件缓存的配置
```
    'prefix'   => 'GraceEasy',                                        // cookie prefix 前缀
    'securekey'=> 'ekOt4_Ut0f3XE-fJcpBvRFrg506jpcuJeixezgPNyALm',     // encrypt key   密钥
    'expire'   => 36000,     //超时时间
];
```

### 封装

无

### API


      public function set($name, $value, $expire=0){
      }

      /** 读取cookie
       * @param String $name  cookie name
       * @return mixed     cookie value
       */
      public function get($name){
      }

      /** 更新cookie,只更新内容,如需要更新过期时间请使用set方法
       * @param String $name  cookie name
       * @param mixed $value cookie value
       * @return boolean
       */
      public function update($name, $value){
      }

      /** 清除cookie
       * @param String $name  cookie name
       */
      public function clear($name){
      }

      /** 设置前缀
       * @param String $prefix cookie prefix
       */
      public function setPrefix($prefix){
      }

      /** 设置过期时间
       * @param int $expire cookie expire
       */
      public function setExpire($expire){
      }




### 示例

//todo

### 注意

无
