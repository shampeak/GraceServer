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
    public $ObjectConfig = array();          //服务对象配置信息存储
    //服务对象存储
    public $Providers = array();             //服务对象存储 映射
    //对象映射
    public $FileReflect = array();           //服务对象存储 映射
    //对象实例
    public $Instances = array();             //服务对象存储 实例
    private $Baseroot = '';

//    public function ConfigRoot($Baseroot)
//    {
//        if(!empty($Baseroot)){
//            $this->Baseroot = $Baseroot?:__DIR__.'/Config/';
//            $_ObjectConfig    = $this->load( $this->Baseroot.'Server.php');           //对象映射
//            $this->FileReflect      = $_ObjectConfig['FileReflect'];         //配置文件映射
//            $this->Providers        = $_ObjectConfig['Providers'];           //对象映射
//
//            if(is_array($this->FileReflect)){
//                foreach($this->FileReflect as $key=>$file){
//                    $this->ObjectConfig[ucfirst($key)] =  $this->load($this->Baseroot.$file);
//                }
//            }
//        }
//        return $this;
//    }

    /**
     * Server constructor.
     *
     * @param $Baseroot
     */
    private function __construct($Baseroot)
    {
        if (!empty($Baseroot)) {
            $this->Baseroot = $Baseroot ?: __DIR__ . '/Config/';
            $_ObjectConfig = $this->load($this->Baseroot . 'Server.php');           //对象映射
            $this->FileReflect = $_ObjectConfig['FileReflect'];         //配置文件映射
            $this->Providers = $_ObjectConfig['Providers'];           //对象映射

            if (is_array($this->FileReflect)) {
                foreach ($this->FileReflect as $key => $file) {
                    $this->ObjectConfig[ucfirst($key)] = $this->load($this->Baseroot . $file);
                }
            }
        }else{
            $this->Baseroot = $Baseroot;
        }
    }


    /**
     * @param string $Baseroot
     *
     * @return Server|null
     */
    public static function getInstance($Baseroot = '')
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self($Baseroot);
        }
        return self::$_instance;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function Config($key)
    {
        return $this->ObjectConfig[ucfirst($key)];
    }

    /**
     * @return array
     * 容器对象列表
     */
    public function obList()
    {
        return $this->Providers;
    }

    /**
     * @param       $abstract
     * @param array $parameters
     *
     * @return mixed|null
     */
    public function make($abstract, $parameters = [])
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
        $parameters = $parameters ?: isset($this->ObjectConfig[$abstract]) ? $this->ObjectConfig[$abstract] : [];
        $this->Instances[$abstract] = $this->build($abstract, $parameters);
        return $this->Instances[$abstract];
    }

    /**
     * @param       $abstract
     * @param array $parameters
     *
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
     *
     * @return array|mixed
     */
    public function load($file = '')
    {
        if (file_exists($file)) {
            return include $file;
        }
        return [];
    }


    //=============================================
    //Property Overloading
    //=============================================

    /**
     *
     */
    public function test()
    {
        //do something
    }

    /**
     * @return array
     */
    private function objectList()
    {
        return [
            'Index'     => 'index.md',
            'Server'    => 'readme.md',
            'Base'      => '../Base/readme.md',
            'Cache'     => '../Cache/readme.md',
            'Cookies'   => '../Cookies/readme.md',
            'Db'        => '../Db/readme.md',
            'Parsedown' => '../Parsedown/readme.md',
            'Req'       => '../Req/readme.md',
            'Smarty'    => '../Smarty/readme.md',
            'View'      => '../View/readme.md',
            'Wise'      => '../Wise/readme.md',
            'Xls'       => '../Xls/readme.md',
        ];
    }

    /**
     * 调用 server()->help();
     */
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
        foreach ($objectList as $key => $value) {
            if ($key == $chr) {
                $nav .= "<li  class=\"active\"><a href=\"?chr=$key\"> $key </a></li>";
            } else {
                $nav .= "<li><a href=\"?chr=$key\"> $key </a></li>";
            }
        }

        $nr = '';
        if ($objectList[$chr]) {
            //获取内容
            $file = $objectList[$chr];
            $nr = (new \Parsedown())->text(file_get_contents(__DIR__ . '/' . $file));

        } else {
            $nr = '';
        }

        $html = str_replace('##nav##', $nav, $tpl);
        $html = str_replace('##nr##', $nr, $html);
        $html = str_replace('##title##', $title, $html);
        echo $html;
        exit;
    }


}
