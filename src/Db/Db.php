<?php

namespace Grace\Db;

use Grace\Base\Base;

/*
 * 进一步设计,优化 : 包括
 * 读写分离
 * 垂直分库
 * 水平分库
 */

class Db extends Base
{
    private $_config = array();

    public $version = '';  //Mysql版本

    private $settings = array(); //当前连接的配置

    public $slowquery = 0;      //配置文件中定义 //慢查询记录时间 超过这个时间,进行记录
    private $rootpath = '';      //配置文件中定义

    //连接实例
    public $link_id = null;

    //查询次数记录
    public $queryCount = 0;

    //查询语句的列表 用作记录
    public $queryLog = array();

    public $error_message = array();         //错误信息结果集

    public $retemp = array();              //临时结果集 gsql的结果集临时存储

    /**
     * Db constructor.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_config = $config;
        $this->settings = array(
            'hostname' => $config['hostname'],
            'port' => $config['port'],
            'username' => $config['username'],
            'password' => $config['password'],
            'database' => $config['database'],
            'charset' => $config['charset'] ?: 'utf8',
            'pconnect' => $config['pconnect'],
            'quiet' => $config['quiet'],
        );
        $this->slowquery = $config['slowquery'];
        $this->rootpath = $config['rootpath'];

        $path = rtrim($this->rootpath, '/') . '/Slowquery';
        //目录不存在就创建
        if (!is_readable($path)) {
            is_file($path) or mkdir($path, 0700);
        }

        //持久连接
        if ($this->settings['pconnect']) {
            if (!$this->connect()) {
                if (!$this->settings['quiet']) {
                    $this->ErrorMsg("Can't Connect MySQL Server({$this->settings['hostname']}:{$this->settings['port']})!");
                }
            }
        }
    }

    /**
     * @return bool
     */
    private function connect()
    {
        $dbhost = $this->settings['hostname'];
        if ($this->settings['port']) {
            $dbhost = $dbhost . ':' . $this->settings['port'];
        }

        $BT = microtime(true);        //对连接开始时间进行标记

        //建立连接实例
        $this->link_id = @mysql_connect($dbhost, $this->settings['username'], $this->settings['password'],
            true);         //非持久连接

        if (!$this->link_id) {
            if (!$this->settings['quiet']) {
                $this->ErrorMsg("Can't Connect MySQL Server($dbhost:{$this->settings['port']})!");
            }
            return false;
        }

        //5.0以下的Msql就别玩了
        //获取数据库版本
        $this->version = mysql_get_server_info($this->link_id);
        if ($this->version() < '5.0') {
            $this->ErrorMsg("Come on ! 5.0以下的Mysql数据库就别玩了!");
        }

        mysql_query("
                        SET character_set_connection={$this->settings['charset']},
                        character_set_results={$this->settings['charset']},
                        character_set_client=binary",
            $this->link_id
        );
        mysql_query("SET sql_mode=''", $this->link_id);

        $ET = microtime(true);        //对连接结束时间进行标记

        //记录慢查询
        if (($ET - $BT) > 0.5) {
            $str = 'linkTM : ' . ($ET - $BT) . ' : ' . date('Y-m-d H:i:s') . "\r\n----------------------------\r\n";
            $cachefile = rtrim($this->rootpath, '/') . '/Slowquery/slowquery.php';
            @file_put_contents($cachefile, $str, FILE_APPEND);
        }

        /* 选择数据库 */
        if ($this->settings['database']) {
            if (mysql_select_db($this->settings['database'], $this->link_id) === false) {
                if (!$this->settings['quiet']) {
                    $this->ErrorMsg("Can't select MySQL database({$this->settings['database']})!");
                }
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    /**
     * @param $dbname
     *
     * @return mixed
     */
    public function select_database($dbname)
    {
        return mysql_select_db($dbname, $this->link_id);
    }

    /**
     * @param        $sql
     * @param string $type
     *
     * @return mixed
     */
    public function query($sql, $type = '')
    {
        if ($this->link_id === null) {
            $this->connect();
        }

        $this->queryCount++;          //总的查询次数
        $this->queryLog[] = $sql;     //记录查询语句

        $BT = microtime(true);        //对查询开始时间进行标记

        /* 当当前的时间大于类初始化时间的时候，自动执行 ping 这个自动重新连接操作 */
        if (!($query = mysql_query($sql, $this->link_id)) && $type != 'SILENT') {
            $this->error_message[]['message'] = 'MySQL Query Error';
            $this->error_message[]['sql'] = $sql;
            $this->error_message[]['error'] = mysql_error($this->link_id);
            $this->error_message[]['errno'] = mysql_errno($this->link_id);
            $this->ErrorMsg();
        }

        $ET = microtime(true);        //对查询结束时间进行标记

        //记录慢查询
        if (($ET - $BT) > $this->slowquery) {
            $str = $sql . "\r\n" . 'TM : ' . ($ET - $BT) . ' : ' . date('Y-m-d H:i:s') . "\r\n----------------------------\r\n";
            $cachefile = rtrim($this->rootpath, '/') . '/Slowquery/slowquery.php';
            @file_put_contents($cachefile, $str, FILE_APPEND);
        }

        //查询失败
        if ($query === false) {
            $this->ErrorMsg("query error!");
        }
//            $this->queryres = $query;   //记过暂存

        return $query;
    }


    //-------------------------------------------------------------------
    //查询开始
    /**
     * @param      $sql
     * @param bool $limited
     *
     * @return string
     */
    function getOne($sql, $limited = false)
    {
        if ($limited == true) {
            $sql = trim($sql . ' LIMIT 1');
        }
        $row = mysql_fetch_row($this->query($sql));
        if ($row !== false) {
            return $row[0];
        } else {
            return '';
        }
    }

    /**
     * @param      $sql
     * @param bool $limited
     *
     * @return mixed
     */
    function getRow($sql, $limited = false)
    {
        if ($limited == true) {
            $sql = trim($sql . ' LIMIT 1');
        }
        $vsr = mysql_fetch_assoc($this->query($sql));

        return $vsr;
    }

    /**
     * @param        $sql
     * @param string $str
     *
     * @return array
     */
    public function getAll($sql, $str = '')
    {

        $res = $this->query($sql);
        $arr = array();
        while ($row = mysql_fetch_assoc($res)) {
            if (empty($str)) {
                $arr[] = $row;
            } else {
                $arr[$row[$str]] = $row;
            }
        }
        return $arr;
    }

    /**
     * @param $sql
     *
     * @return array
     */
    function getMap($sql)
    {
        $res = $this->query($sql);
        //===================================
        $arr = array();
        while ($row = mysql_fetch_row($res)) {
            $arr[$row[0]] = $row[1];
        }
        return $arr;
    }


    /**
     * @param $sql
     *
     * @return array
     */
    function getCol($sql)
    {
        $res = $this->query($sql);
        $arr = array();
        while ($row = mysql_fetch_row($res)) {
            $arr[] = $row[0];
        }
        return $arr;
    }

    //===================================================================
    //只会执行一遍的语法结构,,会把结果缓存起来
    //再次遇到该类型的话,直接读取缓存,输出 存储位置$retemp
    //===================================================================
    /**
     * @param        $sql
     * @param string $type
     * @param string $str
     *
     * @return array|bool|mixed|string
     */
    function gsql($sql, $type = 'all', $str = '')
    {        //$retemp
        $markstr = $sql . $type;
        if (!empty($this->retemp[$markstr])) {
            return $this->retemp[$markstr];
        }
        switch ($type) {
            case 'all':
                $rc = $this->getAll($sql, $str);
                $this->retemp[$markstr] = $rc;
                return $rc;
                break;
            case 'one':
                $rc = $this->getOne($sql);
                $this->retemp[$markstr] = $rc;
                return $rc;
                break;
            case 'row':
                $rc = $this->getRow($sql);
                $this->retemp[$markstr] = $rc;
                return $rc;
                break;
            case 'col':
                $rc = $this->getCol($sql);
                $this->retemp[$markstr] = $rc;
                return $rc;
                break;
            case 'map':
                $rc = $this->getMap($sql);
                $this->retemp[$markstr] = $rc;
                return $rc;
                break;
        }
        return false;
    }

    /* 仿真 Adodb 函数 */
    /**
     * @param        $table
     * @param        $field_values
     * @param string $mode
     * @param string $where
     * @param string $querymode
     *
     * @return bool|mixed
     */
    function autoExecute($table, $field_values, $mode = 'INSERT', $where = '', $querymode = '')
    {
        $field_names = $this->getCol('DESC ' . $table);
        $sql = '';


        if ($mode == 'INSERT') {
            $fields = $values = array();
            foreach ($field_names AS $value) {
                if (array_key_exists($value, $field_values) == true) {
                    $fields[] = '`' . $value . '`';
                    $values[] = "'" . $field_values[$value] . "'";
                }
            }

            if (!empty($fields)) {
                $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ',
                        $values) . ')';
            }
        } else {
            $sets = array();
            foreach ($field_names AS $value) {
                if (array_key_exists($value, $field_values) == true) {
                    $sets[] = '`' . $value . '`' . " = '" . $field_values[$value] . "'";
                }
            }
            if (!empty($sets)) {
                $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
            }
        }
        //echo $sql;
        if ($sql) {
            return $this->query($sql, $querymode);
        } else {
            return false;
        }
    }

//
//      function autoReplace($table, $field_values, $update_values, $where = '', $querymode = ''){
//            $field_descs = $this->getAll('DESC ' . $table);
//
//            $primary_keys = array();
//            foreach ($field_descs AS $value){
//                  $field_names[] = $value['Field'];
//                  if ($value['Key'] == 'PRI'){
//                        $primary_keys[] = $value['Field'];
//                  }
//            }
//
//            $fields = $values = array();
//            foreach ($field_names AS $value){
//                  if (array_key_exists($value, $field_values) == true){
//                        $fields[] = $value;
//                        $values[] = "'" . $field_values[$value] . "'";
//                  }
//            }
//
//            $sets = array();
//            foreach ($update_values AS $key => $value){
//                  if (array_key_exists($key, $field_values) == true){
//                        if (is_int($value) || is_float($value)){
//                              $sets[] = $key . ' = ' . $key . ' + ' . $value;
//                        }else{
//                              $sets[] = $key . " = '" . $value . "'";
//                        }
//                  }
//            }
//
//            $sql = '';
//            if (empty($primary_keys)){
//                  if (!empty($fields)){
//                        $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
//                  }
//            }else{
//                  if ($this->version() >= '4.1'){
//                        if (!empty($fields)){
//                              $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
//                              if (!empty($sets)){
//                                    $sql .=  'ON DUPLICATE KEY UPDATE ' . implode(', ', $sets);
//                              }
//                        }
//                  }else{
//                        if (empty($where)){
//                              $where = array();
//                              foreach ($primary_keys AS $value){
//                                    if (is_numeric($value)){
//                                          $where[] = $value . ' = ' . $field_values[$value];
//                                    }else{
//                                          $where[] = $value . " = '" . $field_values[$value] . "'";
//                                    }
//                              }
//                              $where = implode(' AND ', $where);
//                        }
//
//                        if ($where && (!empty($sets) || !empty($fields))){
//                              if (intval($this->getOne("SELECT COUNT(*) FROM $table WHERE $where")) > 0){
//                                    if (!empty($sets)){
//                                          $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
//                                    }
//                              }else{
//                                    if (!empty($fields)){
//                                          $sql = 'REPLACE INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
//                                    }
//                              }
//                        }
//                  }
//            }
//
//            if ($sql){
//                  return $this->query($sql, $querymode);
//            }else{
//                  return false;
//            }
//      }


    /**
     * @return string
     */
    public function version()
    {
        return $this->version;
    }

    /**
     * @param string $message
     * @param string $sql
     */
    public function ErrorMsg($message = '', $sql = '')
    {
        if ($message) {
            echo "<b>info</b>: $message\n\n<br /><br />";
        } else {
            echo "<b>MySQL server error report:";
            print_r($this->error_message);
        }
        exit;
    }


    //------------------------------------------------------------
    //元操作

    /**
     * @return mixed
     */
    public function insert_id()
    {
        return mysql_insert_id($this->link_id);
    }

    /**
     * @return mixed
     */
    public function close()
    {
        return mysql_close($this->link_id);
    }

    //脚手架
    public function test()
    {
        //do something
    }


}
