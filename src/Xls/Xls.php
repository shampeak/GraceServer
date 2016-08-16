<?php

namespace Grace\Xls;

class Xls
{
    private $_instance = null;
    private $_Config = null;

    /**
     * Xls constructor.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_Config = $config;
        include(__DIR__ . '/Excel/reader.php');
        $this->_instance = new \Spreadsheet_Excel_Reader();
        $this->_instance->setOutputEncoding('UTF-8');
    }

    /**
     * @return \Spreadsheet_Excel_Reader
     */
    public function Spreadsheet_Excel_Reader()
    {
        return $this->_instance->Spreadsheet_Excel_Reader();
    }

    /**
     * @param $encoding
     */
    public function setOutputEncoding($encoding)
    {
        return $this->_instance->setRowColOffset($encoding);
    }

    /**
     * @param string $encoder
     */
    public function setUTFEncoder($encoder = 'iconv')
    {
        return $this->_instance->setUTFEncoder($encoder);
    }

    /**
     * @param $iOffset
     */
    public function setRowColOffset($iOffset)
    {
        return $this->_instance->setRowColOffset($iOffset);
    }

    /**
     * @param $sFormat
     */
    public function setDefaultFormat($sFormat)
    {
        return $this->_instance->setDefaultFormat($sFormat);
    }

    /**
     * @param $column
     * @param $sFormat
     */
    public function setColumnFormat($column, $sFormat)
    {
        return $this->_instance->setColumnFormat($column, $sFormat);
    }

    /**
     * @param $sFileName
     */
    public function read($sFileName)
    {
        return $this->_instance->read($sFileName);
    }

    /**
     * @return bool
     */
    public function _parse()
    {
        return $this->_instance->_parse();
    }

    /**
     * @param $spos
     *
     * @return int
     */
    public function _parsesheet($spos)
    {
        return $this->_instance->_parsesheet($spos);
    }

    /**
     * @param $spos
     *
     * @return bool
     */
    public function isDate($spos)
    {
        return $this->_instance->isDate($spos);
    }

    /**
     * @param $numValue
     *
     * @return array
     */
    public function createDate($numValue)
    {
        return $this->_instance->createDate($numValue);
    }

    /**
     * @param $spos
     *
     * @return float|int
     */
    public function createNumber($spos)
    {
        return $this->_instance->createNumber($spos);
    }

    /**
     * @param        $row
     * @param        $col
     * @param        $string
     * @param string $raw
     */
    public function addcell($row, $col, $string, $raw = '')
    {
        return $this->_instance->addcell($row, $col, $string, $raw);
    }

    /**
     * @param $rknum
     *
     * @return float|int
     */
    public function _GetIEEE754($rknum)
    {
        return $this->_instance->_GetIEEE754($rknum);
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function _encodeUTF16($string)
    {
        return $this->_instance->_encodeUTF16($string);
    }

    /**
     * @param $data
     * @param $pos
     *
     * @return int
     */
    public function _GetInt4d($data, $pos)
    {
        return $this->_instance->_GetInt4d($data, $pos);
    }


    //=============================================
    //Property Overloading
    //=============================================

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->_instance->$key;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function __set($key, $value)
    {
        return $this->_instance->$key = $value;
    }

    /**
     *
     */
    public function test()
    {
        $this->_instance->read(__DIR__ . '/Excel/test.xls');
        //D( $this->_xls->sheets);
        print_r($this->_instance->sheets);
    }


}
