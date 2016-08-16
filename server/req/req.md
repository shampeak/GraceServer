## Req
#### 控制层获取请求参数 ####

示例

```
print_r(req('Get'))

```
返回结果
```
Array
(
    [params] => test
    [c] => home
    [a] => index
    [name] => sun
    [age] => 12
    [/home/index/test] => 
)

```
定义和用法

```
$get = req('get');
$name = $get['name']
$a = $get['a']
echo $name.$a

```

说明

```
req([
            'Get'   => $req->get,
            'Post'  => $req->post,
            'Env'   => $req->env,
            'Router'=> [
                'type'      => $req->env['REQUEST_METHOD'],
                'controller'    => ucfirst(strtolower($controller)),
                'mothed'        => ucfirst(strtolower($mothed)),
                'params'        => $req->get['params'],
                'Prefix'        => 'do',
            ],
        ]);
        

入口文件封装了这几个快捷请求参数你可以通过
1. req('Get')
2. req('Post')
3. req('Env')
4. req('Router')
5. req() （获取以上所有参数）

这几个方法获取你想要的参数

```

字典 （req()所有参数数组）

```
Array
(
    [Get] => Array
        (
            [params] => test
            [c] => home
            [a] => index
            [name] => sun
            [age] => 12
            [/home/index/test] => 
        )

    [Post] => Array
        (
        )

    [Env] => Array
        (
            [path] => home/index/test
            [query] => name=sun&age=12
            [REQUEST_METHOD] => GET
            [REMOTE_ADDR] => 127.0.0.1
            [SCRIPT_NAME] => 
            [HTTP_HOST] => stand.com
            [input.POST] => 
        )

    [Router] => Array
        (
            [type] => GET
            [controller] => Home
            [mothed] => Index
            [params] => test
            [Prefix] => do
        )

)

```
