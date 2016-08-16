## Grace\smarty
> smarty模板的封装

### 依赖

"require": {
    "smarty/smarty": "v3.1.30"
},

### 封装
```
    if (! function_exists('view')) {
        function view($tpl = null, $data = [])
        {
            server('Smarty')->router(req('Router'))->display($tpl,$data);
        }
    }
```

### 示例


