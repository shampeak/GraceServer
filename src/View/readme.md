## Grace\view
> 前端试图对象

### 依赖

无

### 封装
```
    if (! function_exists('view')) {
        function view($tpl = null, $data = [])
        {
            $views = server('View')->router(req('Router'));
            $views->display($tpl, $data);
        }
    }
```

### 示例


