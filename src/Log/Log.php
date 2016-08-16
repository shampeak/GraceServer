<?php

namespace Grace\Log;

class Log
{
    /**
     * Detailed debug information
     */
    const DEBUG = 100;

    /**
     * Interesting events
     *
     * Examples: User logs in, SQL logs.
     */
    const INFO = 200;

    /**
     * Uncommon events
     */
    const NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    const WARNING = 300;

    /**
     * Runtime errors
     */
    const ERROR = 400;

    /**
     * Critical conditions
     *
     * Example: Application component unavailable, unexpected exception.
     */
    const CRITICAL = 500;

    /**
     * Action must be taken immediately
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    const ALERT = 550;

    /**
     * Urgent alert.
     */
    const EMERGENCY = 600;

    /**
     * Monolog API version
     *
     * This is only bumped when API breaks are done and should
     * follow the major version of the library
     *
     * @var int
     */
    const API = 1;

    /**
     * Logging levels from syslog protocol defined in RFC 5424
     *
     * @var array $levels Logging levels
     */
    protected static $levels = [
        self::DEBUG => 'DEBUG',
        self::INFO => 'INFO',
        self::NOTICE => 'NOTICE',
        self::WARNING => 'WARNING',
        self::ERROR => 'ERROR',
        self::CRITICAL => 'CRITICAL',
        self::ALERT => 'ALERT',
        self::EMERGENCY => 'EMERGENCY',
    ];

    private $_instance = null;     //缓存实例
    private $_adapter = null;     //适配

    /**
     * Log constructor.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_Config = $config;
        $this->_instance = new \Monolog\Logger('Stand');
        $this->_adapter = new \Monolog\Handler\StreamHandler($config['path'], \Monolog\Logger::WARNING);
        $this->_instance->pushHandler($this->_adapter);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_instance->name;
    }

    /**
     * Adds a log record at the DEBUG level.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function addDebug($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::DEBUG, $message, $context);
    }

    /**
     * Adds a log record at the INFO level.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function addInfo($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::INFO, $message, $context);
    }

    /**
     * Adds a log record at the NOTICE level.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function addNotice($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::NOTICE, $message, $context);
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function addWarning($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::WARNING, $message, $context);
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function addError($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::ERROR, $message, $context);
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function addCritical($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::CRITICAL, $message, $context);
    }

    /**
     * Adds a log record at the ALERT level.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function addAlert($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::ALERT, $message, $context);
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function addEmergency($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::EMERGENCY, $message, $context);
    }

    /**
     * Gets all supported logging levels.
     *
     * @return array Assoc array with human-readable level names => level codes.
     */
    public static function getLevels()
    {
        return array_flip(\Monolog\Logger::$levels);
    }


    /**
     * Adds a log record at an arbitrary level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  mixed  $level   The log level
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function log($level, $message, array $context = array())
    {
        $level = \Monolog\Logger::toMonologLevel($level);

        return $this->_instance->addRecord($level, $message, $context);
    }

    /**
     * Adds a log record at the DEBUG level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function debug($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::DEBUG, $message, $context);
    }

    /**
     * Adds a log record at the INFO level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function info($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::INFO, $message, $context);
    }

    /**
     * Adds a log record at the NOTICE level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function notice($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::NOTICE, $message, $context);
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function warn($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::WARNING, $message, $context);
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function warning($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::WARNING, $message, $context);
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function err($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::ERROR, $message, $context);
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function error($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::ERROR, $message, $context);
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function crit($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::CRITICAL, $message, $context);
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function critical($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::CRITICAL, $message, $context);
    }

    /**
     * Adds a log record at the ALERT level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function alert($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::ALERT, $message, $context);
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function emerg($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::EMERGENCY, $message, $context);
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string $message The log message
     * @param  array  $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function emergency($message, array $context = array())
    {
        return $this->_instance->addRecord(\Monolog\Logger::EMERGENCY, $message, $context);
    }

    /**
     * Set the timezone to be used for the timestamp of log records.
     *
     * This is stored globally for all Logger instances
     *
     * @param \DateTimeZone $tz Timezone object
     */
    public static function setTimezone(\DateTimeZone $tz)
    {
        \Monolog\Logger::$timezone = $tz;
    }


}


