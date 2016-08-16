## server
#### 加载配置文件到对应的底层类并new对象（单例模式 server层） ####

示例

```
$cookie = server('cookies');
$cookie->get('nsc');
$cookie->set('bt','world');

```
配置文件

```
cookie对应的配置文件路径： /Application/Config/Cookies.php

```

底层类

```
cookie对应的底层类路径：/vendor/grace/server/Cookies/Cookies.php

```

#### 拓展 ####

##### 加载包 #####
```
如果你想拓展底层，或者有更好的想法，想在底层添加新的功能文件，就需要这三步
1、路径： /Application/Config/Server.php
   FileReflect数组中添加你的配置文件映射(如果存在)
   Providers 数组中添加你的类映射 (注意命名空间)
2、路径：  /Application/Config下添加你的配置文件 （如果存在）
3、路径： /vendor/grace/server添加你的类文件（不建议在此处更改）

注意：GraceStand支持composer
      你可以通过composer来下载对应的包之后,进行以上配置

```
示例

```
GraceStand集成的markdown解析器parsedown

1、通过composer下载对应的包
   "require": {
       "erusev/parsedown": "^1.6"
    }
2、配置文件 
3、路径： /Application/Config/Server.php
   'Providers'=>[
        'Parsedown' => Parsedown::class
    ],
ok
```

##### 获取server配置类文件列表 #####

```
注册类列表

server()->obList();

输出结果

Array
(
    [Smarty] => Grace\Smarty\Smarty
    [Req] => Grace\Req\Req
    [View] => Grace\View\View
    [Db] => Grace\Db\Db
    [Cookies] => Grace\Cookies\Cookies
    [Parsedown] => Parsedown
)

```

#####  读取某server配置文件中某一注册的配置文件 #####

```
server()->Config('Application');

输出结果

Array
(
    [Document] => Application\Application\Document
    [Data] => Application\Application\Data
    [Parsedown] => Parsedown
)

```
