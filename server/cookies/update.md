## update
#### 更新cookie ####

示例
```
$server = server('cookies');
$server->set('nsc','hello',160);
$cookie=$server->get('nsc');
$server->set('bt','hello',160);
$check = $server->update('bt','world');
$cookie2=$server->get('bt');
echo $cookie.'<br>'.$check.'<br>'.$cookie2;
```
输出结果
```
hello
1
world

```


定义和用法
```
update()函数更新cookie的值(cokkie的有效期不变)
```
语法

```
update($name,$value)

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
        <td>$value</td>
        <td>mixed</td>
        <td>cookie的值，可选参数类型：字符串、数组、对象等</td>
    </tr>
</table>

<br>

返回值
```
如果更新成功返回true,否则返回false
若待更新cookie不存在或已过期均返回false

```

