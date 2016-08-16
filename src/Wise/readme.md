## Grace\wise
> 数据总线的操作

### 依赖
无

### 封装
```
    /*
    |------------------------------------------------------
    | 数据流 bus sc dc
    |------------------------------------------------------
    */
    //中间数据层配置
    if (! function_exists('sc')) {
        function sc($key = '', $value = array())    {
            return channel('sc',func_num_args(),$key,$value);
        }
    }

    //用户层信息流配置
    if (! function_exists('bus')) {
        function bus($key = '', $value = array())   {
            return channel('bus',func_num_args(),$key,$value);
        }
    }

    //config.php 配置
    if (! function_exists('dc')) {
        function dc($key = '', $value = array())    {
            return channel('dc',func_num_args(),$key,$value);
        }
    }

    //request 配置
    if (! function_exists('req')) {
        function req($key = '', $value = array())    {
            return channel('req',func_num_args(),$key,$value);
        }
    }

    if (! function_exists('channel')) {
        function channel($channel,$args = 0,$key = '', $value = array())
        {
            return Grace\Wise\Wise::getInstance()->channel($channel)->C($args,$key, $value);
        }
    }
```

### 示例


