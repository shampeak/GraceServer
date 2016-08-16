<?php

namespace Grace\Base;

class Help
{
    /**
     * @return mixed
     */
    public static function getpl()
    {
        $tpl = file_get_contents(__DIR__ . '/index.tpl');
        return $tpl;
    }

    /**
     * @return mixed
     */
    public static function getplframe()
    {
        $tpl = file_get_contents(__DIR__ . '/indexframe.tpl');
        return $tpl;
    }

    /**
     * @return mixed
     */
    public static function getpldepend()
    {
        $tpl = file_get_contents(__DIR__ . '/depend.tpl');
        return $tpl;
    }

}
