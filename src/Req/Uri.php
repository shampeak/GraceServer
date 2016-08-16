<?php

namespace Grace\Req;

class Uri
{

    private static $environment = null;
    private $path = '';

    /**
     * @param bool $refresh
     *
     * @return Uri|null
     */
    public static function getInstance($refresh = false)
    {
        if (is_null(self::$environment) || $refresh) {
            self::$environment = new self();
        }
        return self::$environment;
    }

    //$res = server('req')->path;

    /**
     * Uri constructor.
     */
    public function __construct()
    {
        $this->path = \Grace\Req\Environment::getInstance()->all()['path'];
    }

    /**
     * @return string
     */
    public function getpath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getar()
    {
        $ar = explode('/', trim($this->path, '/'));
        return $ar;
    }

}