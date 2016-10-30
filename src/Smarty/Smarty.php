<?php

namespace Grace\Smarty;

/*
* 视图类
*/
class Smarty
{

    private $root       = '';       //控制器
    private $_controller = '';       //控制器
    private $_mothed    = '';       //方法
    private $_params    = '';       //smarty对象
    private $_sty       = '';       //smarty对象

    /**
     * Smarty constructor.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_config = $config;
        //建立对象
        $this->_sty = new \Smarty;
        $this->_sty->setTemplateDir($config['TemplateDir']);
        $this->_sty->setCompileDir($config['CompileDir']);  //编译
        $this->_sty->setConfigDir($config['ConfigDir']);
        $this->_sty->setCacheDir($config['CacheDir']);
        $this->_sty->debugging = $config['debugging'];
        $this->_sty->caching = $config['caching'];
        $this->_sty->cache_lifetime = $config['cache_lifetime'];      //

        $this->root = $config['TemplateDir'];

    }

    /**
     * @param string $path
     *
     * @return $this
     */
    public function path($path = '')
    {
        $this->_sty->setTemplateDir($path);
        $this->root = $path;
        return $this;
    }

    /**
     * @param array $Router
     *
     * @return $this
     */
    public function router($Router = [])
    {
        /**
         * 'Controller'=> 'Home',
         * 'Mothed'    => 'Mothed',
         * 'Params'    => 'Params',
         */
        $this->_controller = $Router['controller'] ? ucfirst($Router['controller']) : 'Home';
        $this->_mothed = $Router['mothed'] ? ucfirst($Router['mothed']) : 'Index';
        $this->_params = $Router['params'] ? ucfirst($Router['params']) : '';
        return $this;
    }

    /**
     * @param string $tpl
     * @param array  $data
     *
     * @return string
     */
    public function fetch($tpl = '', $data = array())
    {
        if ($data) {
            $this->assign($data);
        }
        $tplFile2 = $tpl ? ucfirst($tpl) : ($this->_params ? ($this->_mothed . '_' . $this->_params) : $this->_mothed);
        $tplFile1 = $tpl ? ucfirst($tpl) : $this->_mothed;

        $_tplFile2 = $this->_controller . '/' . $tplFile2 . '.tpl';
        $_tplFile1 = $this->_controller . '/' . $tplFile1 . '.tpl';

        if (file_exists($this->root . $_tplFile2)) {
            $tplFile = $_tplFile2;
            return $this->_sty->fetch($tplFile);
        } elseif (file_exists($this->root . $_tplFile1)) {
            $tplFile = $_tplFile1;
            return $this->_sty->fetch($tplFile);
        } else {
            echo 'Miss Smarty file : <br>', $_tplFile2;
            echo '<br>or : ', $_tplFile1;
            D([]);
        }
    }

    /**
     * @param string $tpl
     * @param array  $data
     */
    public function display($tpl = '', $data = array())
    {
        if ($data) {
            $this->assign($data);
        }


        $tplFile2 = $tpl ? ucfirst($tpl) : ($this->_params ? ($this->_mothed . '_' . $this->_params) : $this->_mothed);
        $tplFile1 = $tpl ? ucfirst($tpl) : $this->_mothed;


        $_tplFile2 = $this->_controller . '/' . $tplFile2 . '.tpl';
        $_tplFile1 = $this->_controller . '/' . $tplFile1 . '.tpl';


        if (file_exists($this->root . $_tplFile2)) {
            $tplFile = $_tplFile2;
            $this->_sty->display($tplFile);
        } elseif (file_exists($this->root . $_tplFile1)) {
            $tplFile = $_tplFile1;
            $this->_sty->display($tplFile);
        } else {
            echo 'Miss Smarty file : <br>', $_tplFile2;
            echo '<br>or : ', $_tplFile1;
            D([]);
        }
    }

    /**
     * @param string $key
     * @param array  $value
     */
    public function assign($key = '', $value = array())
    {
        if (func_num_args() == 1) {
            if (is_array($key)) {
                foreach ($key as $k => $v) {
                    $this->_sty->assign($k, $v);
                }
            }
        } else {
            $this->_sty->assign($key, $value);
        }
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



