<?php

class Connect
{
    private static ?PDO $instances = null;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }


    public static function getInstance(): PDO
    {
        if (is_null(self::$instances)) {
            $dsn = DB_DRIVER . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
            self::$instances = new PDO($dsn, DB_USER, DB_PASSWORD);
        }
        return self::$instances;
    }
}