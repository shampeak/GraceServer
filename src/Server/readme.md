## Grace\Server
> Server层容器,利用依赖注入的模式封装对象,外部能很方便调用其中封装的对象;

### 依赖

```
    "require": {
        "php": ">=5.5",
        "erusev/parsedown": "^1.6",
        "desarrolla2/cache": "~2.0",
        "smarty/smarty": "v3.1.30",
    },
```


### 配置

```
return [
    //配置文件
    'FileReflect'  => [
        'Config'   => 'Config.php',
        'Application'=>'Application.php',
        'Smarty'   => 'Smarty.php',
        'Db'       => 'Db.php',
        'Cookies'  => 'Cookies.php',
        'Adminauth'=> 'Adminauth.php',
        'Mmcfile'  => 'Mmcfile.php',
        'Cache'    => 'Cache.php'
    ],
    //访问对象
    'Providers'=>[
        'Smarty'    => Grace\Smarty\Smarty::class,
        'Req'       => Grace\Req\Req::class,             //
        'View'      => Grace\View\View::class,           //
        'Db'        => Grace\Db\Db::class,
        'Cookies'   => Grace\Cookies\Cookies::class,
        'Parsedown' => Parsedown::class,
        'Cache'    => Grace\Cache\Cache::class,
    ],

];
```


### 封装函数
```
function server($make = null, $parameters = [])
{
    if (is_null($make)) {
        return \Grace\Server\Server::getInstance('../Config/');
    }
    return \Grace\Server\Server::getInstance('../Config/')->make($make, $parameters);
}
```


### 使用示例


//返回server对象

    $server = server();


//返回容器中的对象

    $db = server('db');


//显示server帮助说明文档

    $server = server()->help();;

//返回配置

    $dbconfig   = server()->config('Db');   //返回db配置

//返回容器所有对象信息

    $server = server()->obList();       //所有容器对象


### 注意

首次实例化需要制定配置路径 例如

    \Grace\Server\Server::getInstance('../Config/');


