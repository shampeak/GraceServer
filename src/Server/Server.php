<?php

namespace Grace\Server;

/*
|------------------------------------------------------
| 在注册表中生成一个类，并且返回
|------------------------------------------------------

*/

class Server
{
    /*
    * @var null
    * 单例调用
    */
    private static $_instance = null;       //单例调用
    //服务对象配置信息存储
    public $ObjectConfig    = array();          //服务对象配置信息存储
    //服务对象存储
    public $Providers       = array();             //服务对象存储 映射
    //对象映射
    public $FileReflect     = array();           //服务对象存储 映射
    //对象实例
    public $Instances       = array();             //服务对象存储 实例
    private $Baseroot = '';

    public function ConfigRoot($Baseroot)
    {
        if(!empty($Baseroot)){
            $this->Baseroot = $Baseroot?:__DIR__.'/Config/';
            $_ObjectConfig    = $this->load( $this->Baseroot.'Server.php');           //对象映射
            $this->FileReflect      = $_ObjectConfig['FileReflect'];         //配置文件映射
            $this->Providers        = $_ObjectConfig['Providers'];           //对象映射

            if(is_array($this->FileReflect)){
                foreach($this->FileReflect as $key=>$file){
                    $this->ObjectConfig[ucfirst($key)] =  $this->load($this->Baseroot.$file);
                }
            }
        }
        return $this;
    }

    public function Config($key)
    {
        return $this->ObjectConfig[ucfirst($key)] ;
    }
    /*
    * @param string $conf
    * 根据配置获取设定
    */
    private function __construct($Baseroot){
        if(!empty($Baseroot)){
            $this->Baseroot = $Baseroot?:__DIR__.'/Config/';
            $_ObjectConfig    = $this->load($this->Baseroot.'Server.php');           //对象映射
            $this->FileReflect      = $_ObjectConfig['FileReflect'];         //配置文件映射
            $this->Providers        = $_ObjectConfig['Providers'];           //对象映射

            if(is_array($this->FileReflect)){
                foreach($this->FileReflect as $key=>$file){
                    $this->ObjectConfig[ucfirst($key)] =  $this->load($this->Baseroot.$file);
                }
            }
        }
    }



    /*
    |------------------------------------------------------------
    | 单例调用
    |------------------------------------------------------------
    */
    public static function getInstance($Baseroot = ''){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self($Baseroot);
        }
        return self::$_instance;
    }


    /**
     * @return array
     * 容器对象列表
     */
    public function obList()
    {
        return $this->Providers;
    }

    /*
    |------------------------------------------------------------
    | 对象调用
    |------------------------------------------------------------
    */
    public function make($abstract,$parameters=[])
    {
        $abstract = ucfirst($abstract);
        if (isset($this->Instances[$abstract])) {
            return $this->Instances[$abstract];
        }
        //未定义的服务类 返回空值;
        if (!isset($this->Providers[$abstract])) {
            return null;
        }
        // echo $abstract;
        $parameters = $parameters?:isset($this->ObjectConfig[$abstract])?$this->ObjectConfig[$abstract]:[];
        $this->Instances[$abstract] = $this->build($abstract,$parameters);
        return $this->Instances[$abstract];
    }

    /**    //禁止外部调用
     * @param       $abstract
     * @param array $parameters
     * 实例化
     * @return mixed
     */
    private function build($abstract, $parameters = [])
    {
        $obj_ = $this->Providers[$abstract];
        $obj = new $obj_($parameters);
        return $obj;
    }

    /**
     * @param string $file
     * 载入配置文件
     * @return array|mixed
     */
    public function load($file=''){
        if(file_exists($file)){
            return include $file;
        }
        return [];
    }

    public function Help2()
    {
        header("Content-type: text/html; charset=utf-8");
        $oblist = print_r($this->obList(),true);
        $obConfig = print_r($this->ObjectConfig,true);
        $env = print_r($this->Config('Config')['Env'],true);

        echo "<pre>
Server Object 简单说明

1 : 创建对象实例
\$server = Grace\Server\Server::getInstance('../Config/');
or
\$server = Grace\Server\Server::getInstance()->ConfigRoot('../Docs/Config/');

2 : 返回配置信息    在Config中定义过的
\$server = Grace\Server\Server::getInstance()->Config('Db');
\$server = Grace\Server\Server::getInstance()->Config('Config');
\$server = Grace\Server\Server::getInstance()->Config('Application');
var_dump(\$server);
exit;

3 : 封装
function server(\$make = null, \$parameters = [])
{
    if (is_null(\$make))     return \Grace\Server\Server::getInstance('../Config/');
    return \Grace\Server\Server::getInstance('../Config/')->make(\$make,\$parameters);
}

4 : 使用
\$server = Grace\Server\Server::getInstance()->ConfigRoot('../Config/')->meke('db');
or
server('db');

===================================================
//系统内参数

\$this->Baseroot :
{$this->Baseroot}

\$this->obList :
$oblist

\$this->ObjectConfig :
$obConfig

//获取某个定义的参数
server('db')->Config('Config')['Env'];
{$env};



</pre>";
        //echo 'Hello Server';
    }

    //=============================================
    //Property Overloading
    //=============================================

    //脚手架
    public function test()
    {
        //do something
    }

    private function objectList()
    {
        return [
            'Server',
            'Cache',
            'Cookies',
            'Db',
            'Parsedown',
            'Req',
            'Smarty',
            'View',
            'Xls',
        ];
    }

    //页面
    public function help()
    {
        //获取显示模板
        $tpl = \Grace\Base\Help::getplframe();

        //oblist
        $objectList = $this->objectList();

        $chr = $title = $_GET['chr'];

        //计算左侧菜单
        //<li  class="active"><a href="/index.php?book=01-grace&lm=controller&ar=controller.md"> Controller </a></li>
        $nav = '';
        foreach($objectList as $value){
            if($value == $chr){
                $nav .= "<li  class=\"active\"><a href=\"?chr=$value\"> $value </a></li>";
            }else{
                $nav .= "<li><a href=\"?chr=$value\"> $value </a></li>";
            }
        }

        $nr = '';
        if(in_array($chr,$objectList)){
            $ob = \Grace\Server\Server::getInstance()->make($chr);
            var_dump($ob);
            $nr  = $ob->helpnr();
        }

        $html = str_replace('##nav##',$nav,$tpl);
        $html = str_replace('##nr##',$nr,$html);
        $html = str_replace('##title##',$title,$html);
        echo $html;
        exit;
    }



    //内容
    public function helpnr()
    {
        return (new \Parsedown())->text(file_get_contents(__DIR__."/readme.md"));
    }




}
