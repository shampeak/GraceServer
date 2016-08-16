## Db
#### GraceStand封装的是mysql驱动(如果你想使用mysqli或者PDO可以根据 [server](http://note.youdao.com/) 来安装拓展) ####

+ query($sql, $type = '') 
  ```
  server('db')->query('select name from user where name = '.$name);
  
  执行sql语句
  
  注：$type 可选 （SILENT）是否为静默模式，如果设置$type即query($sql,'SILENT'),若查询出现错误则不会报错。
  
  ```
+ getOne($sql, $limited = false) 获取一个字段
  ```
  $name = req('Get')['name'];
  server('db')->getOne('select name from user where name = '.$name);
  
  如果你并不能确定查询只返回一条数据，你可以将$limited = true; 源码对sql进行以下操作
  
  $sql = trim($sql . ' LIMIT 1');
  
  ```
  
+ getRow($sql, $limited = false) 获取一行数据
    ```
    $name = req('Get')['name'];
    server('db')->getOne('select * from user where name = '.$name);
 
    $limited作用同getOne()中$limited一样
 
    ```
+ getAll($sql,$str='')  获取所有数据
  ```
  server('db')->getAll('select * from user where sex = 1','name')
  
  查询结果
  
    Array
    (
    [hello] => Array
        (
            [id] => 3
            [name] => hello
            [age] => 13
            [sex] => 1
        )

    [ally] => Array
        (
            [id] => 4
            [name] => ally
            [age] => 15
            [sex] => 1
        )
    )
    
    第二个参数确定生成数组键值，可选

  ```
  
+ getMap($sql)   将数据转换为一个Map集合
  ```
  server('db')->getMap('select name,age from user where sex = 1');
  
  查询结果
  
  Array
    (
    [hello] => 13
    [ally] => 15
    )
  
  ```
  
+ getCol($sql)   获取一列数据
  ```
  server('db')->getCol('select name from user where sex = 1');
  
  查询结果
  
  Array
  (
    [0] => hello
    [1] => ally
  )
  
  ```
  
+ autoExecute($table, $field_values, $mode = 'INSERT', $where = '', $querymode = '')
  ```
  获取前端参数后执行添加或修改操作
  
  $get = req('Post');
  server('db')->autoExecute('user',$get,'INSERT');
  server('db')->autoExecute('user',$get,'UPDATE','name = \'nsc\'');
  注:
  autoExecute(表名，字段_值_数组,操作,条件,模式)
  
  $mode 可选操作（INSERT,UPDATE）区分大小写
  $querymode 静默模式 可选（SILENT）
  
  ```
+ autoReplace($table, $field_values, $update_values, $where = '', $querymode = '')
  ```
  
  
  
  
  
  ```
  
+ version() 返回数据库版本号