## Grace\db
> 数据库操作

### 依赖

无

### 配置

```
return [

        'hostname'      => '127.0.0.1',         //服务器地址
        'port'          => '3306',              //端口
        'username'      => 'root',              //用户名
        'password'      => 'root',              //密码
        'database'      => 'demo',              //数据库名
        'charset'       => 'utf8',              //字符集设置
        'pconnect'      => 0,                   //1  长连接模式 0  短连接
        'quiet'         => 0,                   //安静模式 生产环境的
        'slowquery'     => 1,                   //对慢查询记录
        'rootpath'      => '../Cache/',         //慢查询记录时间
];
```

### API
```
      public function select_database($dbname){
      }
      public function query($sql, $type = ''){
      }
      function getOne($sql, $limited = false){
      }
      function getRow($sql, $limited = false){
      }
      public function getAll($sql,$str=''){
      }
      function getMap($sql){
      }
      function getCol($sql){
      }
      function gsql($sql,$type='all',$str=''){        //$retemp
      }
      function autoExecute($table, $field_values, $mode = 'INSERT', $where = '', $querymode = ''){
      }
      public function version(){
      }
      public function insert_id(){
      }
      public function close(){
      }
```
### 示例