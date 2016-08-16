## Smarty_view
#### smarty模块快捷调用方法view() ####

GraceStand提供了一个快捷方法来显示视图和传递参数 view()

示例

```
浏览器请求地址："/home/index/nsc"

public function doIndex($params='')
    {
        //$name = req('Get')['params'];
        view('',[
           // 'Name'=>$name,
            'Name'=>$params
        ]);
    }

```
输出结果

```
响应视图地址: App/Views/Home/index.tpl

variable modifier example of {$Name|upper}

NSC

```
语法

```
view(tpl='',dataArray)

```

说明

<table border="1" cellpadding="3" cellspaing="3">
    <tr align="center">
        <td width="100px">参数</td>
        <td width="100px">类型</td>
        <td width="200px">说明</td>
    </tr>
    <tr align="center">
        <td>tpl</td>
        <td>string</td>
        <td>显示视图的action,eg index(显示的请求页面视图可省略)</td>
    </tr>
    <tr align="center">
        <td>dataArray</td>
        <td>array</td>
        <td>发送到视图的参数</td>
    </tr>
</table>

注：view()只能显示同一请求控制器下的视图，如果想显示其他范围的视图请查看[smarty](http://note.youdao.com/)
<br>

拓展

+ 请求地址 nsc 是一个快捷参数，url允许带一个快捷参数（最多一个，其他参数后跟？a&b，和正常get一样），示例中两种方式均可





