## server_req
#### server请求参数 ####

数据底层参数获取 (在控制层获取请求参数不建议使用server()方法，GraceStand提供了快捷方法[req()](http://note.youdao.com/))

示例
```
server('req')->env

```
输出结果

```
Array
(
    [path] => home/index/test
    [query] => name=sun&age=12
    [REQUEST_METHOD] => GET
    [REMOTE_ADDR] => 127.0.0.1
    [SCRIPT_NAME] => 
    [HTTP_HOST] => stand.com
    [input.POST] => 
)

```
更多示例
```
浏览器请求url="home/index/test?name=sun&age=12"
```

+ server('req')->post  （post方式请求参数）
```
Array
(
)
```

+ server('req')->get  （get方式请求参数）
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

+ server('req')->getpath   （请求路径）

```
Array
(
    [params] => test
    [c] => home
    [a] => index
)

```

+ server('req')->getquery  (提交数据数组)

```
Array
(
    [name] => sun
    [age] => 12
)

```