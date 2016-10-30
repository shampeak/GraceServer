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
    //服务对象存储
    public $Providers       = array();             //服务对象存储 映射
    public $ProvidersConfig = array();             //配置

    public $config          = array();             //配置

    //对象实例
    public $Instances       = array();             //服务对象存储 实例

    /**
     * Server constructor.
     *
     * @param $Baseroot
     */
    private function __construct($config)
    {
        if (!empty($config)) {
            $this->_config = $config;

            /**
             * 对象相关的配置
             */
            $this->ProvidersConfig  = $config['Server']['ProvidersConfig'];         //配置文件映射

            /**
             * 对象文件映射，在实例化对象前会保持映射状态，IoC
             */
            $this->Providers    = $config['Server']['Providers'];           //对象映射

        }
    }


    /**
     * @param string $Baseroot
     *
     * @return Server|null
     */
    public static function getInstance(array $config = [])
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self($config);
        }
        return self::$_instance;
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

        //已经实例化类 直接返回;
        if (isset($this->Instances[$abstract])) {
            return $this->Instances[$abstract];
        }

        //未定义的服务类 返回空值;
        if (!isset($this->Providers[$abstract])) {
            return null;
        }

        // 还没有实例化，则进行实例化 并且返回
        $parameters = $parameters ?: (isset($this->ProvidersConfig[$abstract]) ? $this->ProvidersConfig[$abstract] : []);
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

}
