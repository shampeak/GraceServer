<?php

namespace Grace\View;

/*
* 视图类
*/
class View
{

    /*
    * 视图文件目录
    * @var string
    */
    private $_tplDir;
    private $router;

    /*
    * 视图文件路径
    * @var string
    */
    private $_viewPath;

    /*
    * 视图变量列表
    * @var array
    */
    private $_data = array();

    /*
    * 给tplInclude用的变量列表
    * @var array
    */
    private static $tmpData;

    /**
     * View constructor.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_config = $config;
        $this->_tplDir = $config['viewpath'];
    }

    /**
     * @param string $viewpath
     *
     * @return $this
     */
    public function viewpath($viewpath = '')
    {
        if (!empty($viewpath)) {
            $this->_tplDir = $viewpath;
        }
        return $this;
    }

    /**
     * @param array $router
     *
     * @return $this
     */
    public function router($router = [])
    {
        /**
         * 获得
         * 'Controller'=> 'Home',
         * 'Mothed'    => 'Mothed',
         */
        $this->router = $router;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     */
    public function assign($key, $value)
    {
        $this->_data[$key] = $value;
    }


    /**
     * @param $tplFile
     * @param $data
     *
     * @return mixed
     */
    public function fetch($tplFile, $data)
    {
        foreach ($data as $key => $value) {
            $this->_data[$key] = $value;
        }

        $Controller = $this->router['controller'] ?: 'Home';
        $Mothed = $this->router['mothed'] ?: "Index";

        $tplFile = $tplFile ? ucfirst($tplFile) : ucfirst($Mothed);
        $this->_viewPath = $this->_tplDir . ucfirst($Controller) . '/' . $tplFile . '.php';

        unset($tplFile);
        extract($this->_data);

        ob_start(); //开启缓冲区
        include $this->_viewPath;
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    /**
     * 渲染模板并输出
     * $tplFile 模板文件路径，相对于App/View/文件的相对路径，不包含后缀名，例如index/index
     * @param $tplFile
     * @param $data
     */
    public function display($tplFile, $data)
    {
        foreach ($data as $key => $value) {
            $this->_data[$key] = $value;
        }

        $Controller = $this->router['controller'] ?: 'Home';
        $Mothed = $this->router['mothed'] ?: "Index";

        $tplFile = $tplFile ? ucfirst($tplFile) : ucfirst($Mothed);
        $this->_viewPath = $this->_tplDir . ucfirst($Controller) . '/' . $tplFile . '.php';
        unset($tplFile);
        extract($this->_data);
        include $this->_viewPath;
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


}



