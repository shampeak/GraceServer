<?php

namespace Grace\Req;

//$res = \Grace\Req\Uri::getInstance()->getpath();
//$res = \Grace\Req\Uri::getInstance()->getar();
//print_r($res);
//exit;

class Uri
{

    private static $environment = null;
    private $path = '';

    /*
     * Get environment instance (singleton)
     */
    public static function getInstance($refresh = false)
    {
        if (is_null(self::$environment) || $refresh) {
            self::$environment = new self();
        }
        return self::$environment;
    }

    //$res = server('req')->path;

    public function __construct()
    {
        $this->path = \Grace\Req\Environment::getInstance()->all()['path'];
    }

    public function getpath()
    {
        return $this->path;
    }

    public function getar()
    {
        $ar = explode('/',trim($this->path,'/'));
        return $ar;
    }

}