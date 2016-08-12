<?php

namespace Grace\Cache;

//use \Desarrolla2\Cache\Adapter\File;

class Cache implements \Desarrolla2\Cache\CacheInterface{ // class start

    private $_instance = null;     //缓存实例
    private $_adapter = null;     //$adapter

    public function __construct($config = array()){

        $this->_Config = $config;
        $this->_adapter = new $config['adapter']($config['cacheDir']);
        $this->_adapter->setOption('ttl', $config['ttl']);
        $this->_instance = new \Desarrolla2\Cache\Cache($this->_adapter);
    }




    /**
     * Delete a value from the cache
     *
     * @param string $key
     */
    public function delete($key){
        return $this->_instance->delete($key);
    }

    /**
     * Retrieve the value corresponding to a provided key
     *
     * @param string $key
     */
    public function get($key){
        return $this->_instance->get($key);
    }

    /**
     *
     * @return \Desarrolla2\Cache\Adapter\AdapterInterface $adapter
     * @throws Exception
     */
    public function getAdapter(){
        return $this->_instance->getAdapter();

    }

    /**
     * Retrieve the if value corresponding to a provided key exist
     *
     * @param string $key
     */
    public function has($key){
        return $this->_instance->has($key);
    }

    /**
     * * Add a value to the cache under a unique key
     *
     * @param string $key
     * @param mixed  $value
     * @param int    $ttl
     */
    public function set($key, $value, $ttl = null){
        return $this->_instance->set($key, $value, $ttl);
    }

    /**
     * Set Adapter interface
     *
     * @param \Desarrolla2\Cache\Adapter\AdapterInterface $adapter
     */
    public function setAdapter(\Desarrolla2\Cache\Adapter\AdapterInterface $adapter){
        return $this->_instance->setAdapter($adapter);
    }

    /**
     * Set option for Adapter
     *
     * @param string $key
     * @param string $value
     */
    public function setOption($key, $value){
        return $this->_instance->setOption($key, $value);
    }

    /**
     * clean all expired records from cache
     */
    public function clearCache(){
        return $this->_instance->clearCache();
    }

    /**
     * clear all cache
     */
    public function dropCache(){
        return $this->_instance->dropCache();
    }

    //=============================================
    //Property Overloading
    //=============================================

    public function __get($key)
    {
        return $this->_instance->$key;
    }

    //脚手架
    public function test()
    {
        //do something
    }

    //页面
    public function help()
    {
        //获取显示模板
        $tpl = \Grace\Base\Help::getpl();

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


} // class end
