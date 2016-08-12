<?php

namespace Grace\Xls;

class Xls
{
      private $_instance     = null;
      private $_Config  = null;

      public function __construct($config = array()){
            $this->_Config = $config;
            include(__DIR__.'/Excel/reader.php');
            $this->_instance = new \Spreadsheet_Excel_Reader();
            $this->_instance->setOutputEncoding('UTF-8');
      }

      public function Spreadsheet_Excel_Reader()
      {
            return $this->_instance->Spreadsheet_Excel_Reader();
      }

      public function setOutputEncoding($encoding)
      {
            return $this->_instance->setRowColOffset($encoding);
      }

      public function setUTFEncoder($encoder = 'iconv')
      {
            return $this->_instance->setUTFEncoder($encoder);
      }

      public function setRowColOffset($iOffset)
      {
            return $this->_instance->setRowColOffset($iOffset);
      }

      public function setDefaultFormat($sFormat)
      {
            return $this->_instance->setDefaultFormat($sFormat);
      }

      public function setColumnFormat($column, $sFormat)
      {
            return $this->_instance->setColumnFormat($column, $sFormat);
      }

      public function read($sFileName)
      {
            return $this->_instance->read($sFileName);
      }

      public function _parse()
      {
            return $this->_instance->_parse();
      }

      public function _parsesheet($spos)
      {
            return $this->_instance->_parsesheet($spos);
      }

      public function isDate($spos)
      {
            return $this->_instance->isDate($spos);
      }

      public function createDate($numValue)
      {
            return $this->_instance->createDate($numValue);
      }

      public function createNumber($spos)
      {
            return $this->_instance->createNumber($spos);
      }

      public  function addcell($row, $col, $string, $raw = '')
      {
            return $this->_instance->addcell($row, $col, $string, $raw);
      }

      public function _GetIEEE754($rknum)
      {
            return $this->_instance->_GetIEEE754($rknum);
      }

      public function _encodeUTF16($string)
      {
            return $this->_instance->_encodeUTF16($string);
      }

      public function _GetInt4d($data, $pos)
      {
            return $this->_instance->_GetInt4d($data, $pos);
      }


      //=============================================
      //Property Overloading
      //=============================================

      public function __get($key)
      {
            return $this->_instance->$key;
      }

      public function __set($key, $value)
      {
            return $this->_instance->$key = $value;
      }

      //脚手架
      public function test()
      {
            $this->_instance->read(__DIR__.'/Excel/test.xls');
            //D( $this->_xls->sheets);
            print_r($this->_instance->sheets);
      }

      //页面
      public function help()
      {
            //获取显示模板
            $tpl = \Grace\Base\Help::getplframe();

            //获取内容解析
            $nr = $this->helpnr();
            $html = str_replace('##nr##',$nr,$tpl);
            echo $html;
            exit;
      }

      //内容
      public function helpnr()
      {
            return (new \Parsedown())->text(file_get_contents(__DIR__."/readme.md"));
      }

}
