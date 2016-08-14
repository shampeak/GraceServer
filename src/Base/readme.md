## Grace\Base
> Server容器的基础对象和函数



### 包含

- Set

    > 基础类,继承\ArrayAccess,\Countable,\IteratorAggregate 这三个接口!

- Base
基础类,继承Set 并且实现了一些方法,可以被继承

- Help
帮助静态类,方法 :
Help::getpl();          //返回一个页面展示模板
Help::getplframe();     //返回一个模板，用在帮助信息

### 配置

无


### 示例

```
class Cookies extend Base{
}

class Cookies extend Set{
}

$tpl = Help::getpl();
$tpl = Help::getplframe();
```
