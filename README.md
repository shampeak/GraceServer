## Grace\Server

## 说明

服务层容器
包括

- 基础类             [Grace/Base/Base](src/Base/readme.md)
- 服务容器           [Grace/Server/Server](src/Server/readme.md)
- Cookie类           [Grace/Cookies/Cookies](src/Cookies/readme.md)
- 数据库访问         [Grace/Db/Db](src/Db/readme.md)
- 请求参数           [Grace/Req/Req](src/Req/readme.md)
- 缓存               [Grace/Cache/Cache](src/Cache/readme.md)
- Markdown文档转Html [Grace/Parsedown/Parsedown](src/Parsedown/readme.md)
- Smarty视图         [Grace/Smarty/Smarty](src/Smarty/readme.md)
- 简单视图           [Grace/View/View](src/View/readme.md)
- 信息流             [Grace/Wise/Wise](src/Wise/readme.md)
- Excel文件读取      [Grace/Xls/Xls](src/Xls/readme.md)
- Log                [Grace/Log/Log](src/Log/readme.md)

## 安装

稳定版本 1.0

```
    composer require grace/server 1.0.x-dev
```

OR

下载打包好的文件[下载](https://github.com/shampeak/GraceServer/archive/master.zip)

## 使用

详见说明文档 [文档](src/Server/Index.md)

## depends

```
    "erusev/parsedown": "^1.6",     //markdown解析
    "desarrolla2/cache":"~2.0",     //缓存
    "smarty/smarty":    "v3.1.30"   //smarty
    "monolog/monolog":  "^1.21",    //日志
```

## 文档

[文档](src/Server/Index.md)
全文档支持站点  PHPleague.

## 作者

GracePHP由shampeak研发小组独立研发
组员
- [Shampeak](https://github.com/shampeak/).


## 协议

本框架支持MIT开源协议,更多信息请参考[License File](LICENSE.md).

