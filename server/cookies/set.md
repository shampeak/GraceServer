## set
#### 设置cookie ####

示例
```
$server = server('cookies');
$server->set('nsc','hello',60);
$cookie=$server->get('nsc');
echo $cookie;

```
输出结果
```
hello

```


定义和用法
```
set()函数添加cookie
```
语法

```
set($name, $value, $expire=0)

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
    <tr align="center">
        <td>value</td>
        <td>mixed</td>
        <td>cookie的值，可选参数类型：字符串、数组、对象等</td>
    </tr>
    <tr align="center">
        <td>time</td>
        <td>int</td>
        <td>cokkie有效时间，默认3600秒，可选</td>
    </tr>
</table>

<br>

返回值
```
无

```
