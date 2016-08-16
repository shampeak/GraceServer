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

+ set       设置cookie
+ get       读取cookie
+ update    更新cookie,只更新内容,如需要更新过期时间请使用set方法
+ clear     清除cookie
+ setPrefix 设置前缀
+ setExpire 设置过期时间

```
public function set($name, $value, $expire=0){
}
public function get($name){
}
public function update($name, $value){
}
public function clear($name){
}
public function setPrefix($prefix){
}
public function setExpire($expire){
}
```

### 示例

//todo

### 注意

无
