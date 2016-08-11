<?php

namespace Grace\Cache;

//use \Desarrolla2\Cache\Adapter\File;

class Cache implements \Desarrolla2\Cache\CacheInterface{ // class start

    private $_cache = null;     //缓存实例
    private $_adapter = null;     //$adapter

    public function __construct($config = array()){
        $this->_Config = $config;

        $this->_adapte = new $config['adapter']($config['cacheDir']);
        $this->_adapte->setOption('ttl', $config['ttl']);
        $this->_cache = new \Desarrolla2\Cache\Cache($this->_adapte);
    }

    /**
     * Delete a value from the cache
     *
     * @param string $key
     */
    public function delete($key){
        return $this->_cache->delete($key);
    }

    /**
     * Retrieve the value corresponding to a provided key
     *
     * @param string $key
     */
    public function get($key){
        return $this->_cache->get($key);
    }

    /**
     *
     * @return \Desarrolla2\Cache\Adapter\AdapterInterface $adapter
     * @throws Exception
     */
    public function getAdapter(){
        return $this->_cache->getAdapter();

    }

    /**
     * Retrieve the if value corresponding to a provided key exist
     *
     * @param string $key
     */
    public function has($key){
        return $this->_cache->has($key);
    }

    /**
     * * Add a value to the cache under a unique key
     *
     * @param string $key
     * @param mixed  $value
     * @param int    $ttl
     */
    public function set($key, $value, $ttl = null){
        return $this->_cache->set($key, $value, $ttl);
    }

    /**
     * Set Adapter interface
     *
     * @param \Desarrolla2\Cache\Adapter\AdapterInterface $adapter
     */
    public function setAdapter(\Desarrolla2\Cache\Adapter\AdapterInterface $adapter){
        return $this->_cache->setAdapter($adapter);
    }

    /**
     * Set option for Adapter
     *
     * @param string $key
     * @param string $value
     */
    public function setOption($key, $value){
        return $this->_cache->setOption($key, $value);
    }

    /**
     * clean all expired records from cache
     */
    public function clearCache(){
        return $this->_cache->clearCache();
    }

    /**
     * clear all cache
     */
    public function dropCache(){
        return $this->_cache->dropCache();
    }

} // class end
