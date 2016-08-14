## Grace\Xls
> data from xls

### 依赖

无



### 示例

- 解析xls

```
//xls文件地址
$xlsfile = __DIR__."/Excel/test.xls";

//读取
$xls->read($xlsfile);

//输出解析数据
print_r($xls->sheets);
```
