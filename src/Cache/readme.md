## Grace\Cache
> 缓存对象

### 依赖

```
    "require": {
        "desarrolla2/cache": "~2.0"
    },

```

### 配置

> 这个是文件缓存的配置
```
return [
    'cacheDir'=>  '../Cache/tmp',
    'adapter'=> \Desarrolla2\Cache\Adapter\File::class,
    'ttl'=> 3600
];
```

### 封装

无

### API
```
    delete($key)
    get($key)
    has($key)
    set($key, $value, $ttl = null)
    clearCache();
```

### 示例
```
    $cache = server('cache');
    $cache->set('name',"irones",3600);
    $cache->get('name');
    $cache->has('name');
    $cache->clearCache();
```
### 注意

无
