<?php

/**
 * Class Database
 * @package App\Core
 * @inheritdoc \PDO
 */
class Database
{

    /**
     * @var Database
     */
    protected static $_instance;
    protected $_pdo;

    private function __construct($host, $db, $username, $password = '')
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $host, $db);
        $this->_pdo = new \PDO($dsn, $username, $password);
    }

    public static function pdo(): \PDO
    {
        return static::instance()->_pdo;
    }

    public static function instance(): Database
    {
        if (is_null(static::$_instance)) {
            static::$_instance = new static('localhost:3306', 'test', 'root', 'root'); // TODO move to config
            if (!function_exists('pdo')) {
                function pdo(): \PDO
                {
                    return Database::pdo();
                }
            }
        }

        return static::$_instance;
    }

    public static function init()
    {
        static::instance();
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([static::instance(), $name], $arguments);
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->_pdo, $name)) {
            return call_user_func_array([$this->_pdo, $name], $arguments);
        }

        return false;
    } // Database::instance()->pdo()->prepare <=> Database::prepare

}