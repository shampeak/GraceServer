## Smarty
#### smarty 视图显示 ####

推荐使用view()快捷方法，若调用请求控制器外的视图请下看

示例

```
浏览器请求地址："/home/index/"

public function doIndex()
    {
        $Router=[
            'controller'=>'Test',
            'mothed'=>'H',
            'params'=>'nsc'
        ];
        server('Smarty')->router($Router)->display('c',[
            'name'=>$Router['params']
        ]);
    }

```

输出结果

```
响应视图地址: App/Views/Test/c.tpl

nsc

```

说明 (Smarty类中存在的可调用的方法)

+ router($Router = []) (获取控制器，方法，快捷参数)
+ display($tpl = '',$data = array()) （显示视图）
+ fetch()



