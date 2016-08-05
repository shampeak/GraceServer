<?php

namespace Grace\View;

/*
* 视图类
*/
class View {

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

      /*
      * @param string $tplDir
      */
      public function __construct($config = array()){
            $this->_config = $config;
            $this->_tplDir = $config['viewpath'];
      }

      public function viewpath($viewpath = '')
      {
            if(!empty($viewpath)){
                  $this->_tplDir = $viewpath;
            }
            return $this;
      }

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
      /*
      * 为视图引擎设置一个模板变量
      * @param string $key 要在模板中使用的变量名
      * @param mixed $value 模板中该变量名对应的值
      * @return void
      */
      public function assign($key, $value) {
            $this->_data[$key] = $value;
      }




      public function fetch($tplFile,$data)
      {
            foreach($data as $key=>$value){
                  $this->_data[$key] = $value;
            }

            $Controller = $this->router['controller']?:'Home';
            $Mothed     = $this->router['mothed']?:"Index";

            $tplFile = $tplFile?ucfirst($tplFile):ucfirst($Mothed);
            $this->_viewPath = $this->_tplDir .ucfirst($Controller).'/'. $tplFile . '.php';

            unset($tplFile);
            extract($this->_data);

            ob_start(); //开启缓冲区
                  include $this->_viewPath;
                  $html = ob_get_contents();
            ob_end_clean();
            return $html;
      }

      /*
      * 渲染模板并输出
      * @param null|string $tplFile 模板文件路径，相对于App/View/文件的相对路径，不包含后缀名，例如index/index
      * @return void
      */
      public function display($tplFile,$data) {


            foreach($data as $key=>$value){
                  $this->_data[$key] = $value;
            }

            $Controller = $this->router['controller']?:'Home';
            $Mothed     = $this->router['mothed']?:"Index";

            $tplFile = $tplFile?ucfirst($tplFile):ucfirst($Mothed);
            $this->_viewPath = $this->_tplDir .ucfirst($Controller).'/'. $tplFile . '.php';
            unset($tplFile);
            extract($this->_data);
            include $this->_viewPath;
      }

}



