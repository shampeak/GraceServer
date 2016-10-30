<?php

namespace Grace\Cache;
use \Memcache as Backend;


class Cache implements \Desarrolla2\Cache\CacheInterface
{ // class start

    private $_instance = null;     //缓存实例
    private $_adapter = null;     //$adapter

    /**
     * Cache constructor.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_Config = $config;

        if($config['cacheType'] == 'File'){
            $this->_adapter = new $config['adapter']($config['cacheDir']);
            $this->_adapter->setOption('ttl', $config['ttl']);
        }
        if($config['cacheType'] == 'Memcache') {
            $memcache = new \Memcache();
            foreach( $config['server'] as $_config) {
                call_user_func_array(array($memcache, 'addServer'), $_config);
            }
            $this->_adapter = new $config['adapter']($memcache);
        }
        $this->_instance = new \Desarrolla2\Cache\Cache($this->_adapter);
    }


    /**
     * Delete a value from the cache
     *
     * @param string $key
     */
    public function delete($key)
    {
        return $this->_instance->delete($key);
    }

    /**
     * Retrieve the value corresponding to a provided key
     *
     * @param string $key
     */
    public function get($key)
    {
        return $this->_instance->get($key);
    }

    /**
     *
     * @return \Desarrolla2\Cache\Adapter\AdapterInterface $adapter
     * @throws Exception
     */
    public function getAdapter()
    {
        return $this->_instance->getAdapter();

    }

    /**
     * Retrieve the if value corresponding to a provided key exist
     *
     * @param string $key
     */
    public function has($key)
    {
        return $this->_instance->has($key);
    }

    /**
     * * Add a value to the cache under a unique key
     *
     * @param string $key
     * @param mixed  $value
     * @param int    $ttl
     */
    public function set($key, $value, $ttl = null)
    {
        return $this->_instance->set($key, $value, $ttl);
    }

    /**
     * Set Adapter interface
     *
     * @param \Desarrolla2\Cache\Adapter\AdapterInterface $adapter
     */
    public function setAdapter(\Desarrolla2\Cache\Adapter\AdapterInterface $adapter)
    {
        return $this->_instance->setAdapter($adapter);
    }

    /**
     * Set option for Adapter
     *
     * @param string $key
     * @param string $value
     */
    public function setOption($key, $value)
    {
        return $this->_instance->setOption($key, $value);
    }

    /**
     * clean all expired records from cache
     */
    public function clearCache()
    {
        return $this->_instance->clearCache();
    }

    /**
     * clear all cache
     */
    public function dropCache()
    {
        return $this->_instance->dropCache();
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

    //脚手架
    public function test()
    {
        //do something
    }


} // class end
