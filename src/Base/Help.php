<?php

namespace Grace\Base;

class Help{
      public static function getpl(){
         $tpl = file_get_contents(__DIR__.'/index.tpl');
            return $tpl;
      }

      public static function getplframe()
      {
          $tpl = file_get_contents(__DIR__.'/indexframe.tpl');
            return $tpl;
      }

}
