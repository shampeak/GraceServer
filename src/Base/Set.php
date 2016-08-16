<?php

namespace Grace\Base;

class Set implements
    \ArrayAccess,
    \Countable,
    \IteratorAggregate
{
    /*
     * Key-value array of arbitrary data
     * @var array
     */
    private $data = array();

    /*
     * Normalize data key
     * @param  string $key The data key
     * @return mixed       The transformed/normalized data key
     */
    protected function normalizeKey($key)
    {
        return $key;
    }

    /*
     * Set data key to value
     * @param string $key   The data key
     * @param mixed  $value The data value
     */
    public function set($key, $value)
    {
        $this->data[$this->normalizeKey($key)] = $value;
    }

    /*
     * Get data value with key
     * @param  string $key     The data key
     * @param  mixed  $default The value to return if data key does not exist
     * @return mixed           The data value, or the default value
     */
    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            $isInvokable = is_object($this->data[$this->normalizeKey($key)]) && method_exists($this->data[$this->normalizeKey($key)],
                    '__invoke');
            return $isInvokable ? $this->data[$this->normalizeKey($key)]($this) : $this->data[$this->normalizeKey($key)];
        }
        return $default;
    }

    /*
     * Add data to set
     * @param array $items Key-value array of data to append to this set
     */
    public function replace($items)
    {
        foreach ($items as $key => $value) {
            $this->set($key, $value); // Ensure keys are normalized
        }
    }


    /*
     * Does this set contain a key?
     * @param  string  $key The data key
     * @return boolean
     */
    public function has($key)
    {
        return array_key_exists($this->normalizeKey($key), $this->data);
    }

    /*
     * Remove value with key from this set
     * @param  string $key The data key
     */
    public function remove($key)
    {
        unset($this->data[$this->normalizeKey($key)]);
    }

    /*
     * Property Overloading
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    public function __isset($key)
    {
        return $this->has($key);
    }

    public function __unset($key)
    {
        return $this->remove($key);
    }

    /*
     * Clear all values
     */
    public function clear()
    {
        $this->data = array();
    }


    /*
     * Array Access
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
    /*
     * end Array Access
     */

    /*
     * Countable ->Countable
     */
    public function count()
    {
        return count($this->data);
    }

    /*
     * IteratorAggregate
     * foreach
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }


    /*
     * Fetch set data
     * @return array This set's key-value data array
     */
    public function all()
    {
        return $this->data;
    }

    /*
     * Fetch set data keys
     * @return array This set's key-value data array keys
     */
    public function keys()
    {
        return array_keys($this->data);
    }

    /*
     * @param $key
     * @param string $file
     * 载入一个文件的配置
     */
    public function load($file = '')
    {
        if (file_exists($file)) {
            return include $file;
        }
        return [];
    }

    /*
     * @param $function_name
     * @param $args
     * 出现不存在的方法,进行信息提示
     */
    function __call($function_name, $args)
    {
        echo get_class($this) . " -> function: $function_name  not exist";
        var_dump($args);
    }

}
