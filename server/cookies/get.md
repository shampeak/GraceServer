## get
#### 获取cookie ####

示例
```
$server = server('cookies');
$server->set('nsc','hello',60);
$cookie=$server->get('nsc');
$cookie = $cookie?$cookie:'cookie is not exist';
$cookie2=$server->get('bt');
$cookie2 = $cookie2?$cookie2:'cookie2 is not exist';
echo $cookie.'<br>';
echo $cookie2;

```
输出结果
```
hello
cookie2 is not exist

```


定义和用法
```
get()函数添加cookie
```
语法

```
get($name)

```
说明

<table border="1" cellpadding="3" cellspaing="3">
    <tr align="center">
        <td width="100px">参数</td>
        <td width="100px">类型</td>
        <td width="200px">说明</td>
    </tr>
    <tr align="center">
        <td>name</td>
        <td>string</td>
        <td>cookie的键名</td>
    </tr>
</table>

<br>

返回值
```
如果该键名（name）对应的cookie存在，则返回cookie的值，否则返回null

```

