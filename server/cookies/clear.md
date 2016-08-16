## clear
#### 清除cookie ####

示例
```
$server = server('cookies');
$server->set('nsc','hello',160);
$server->clear('nsc');
$cookie=$server->get('nsc');
$cookie=$cookie?$cookie:'cookie is not exist';
echo $cookie;

```
输出结果
```
cookie is not exist

```


定义和用法
```
clear()函数清除cookie
```
语法

```
clear($name)

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
无

```

