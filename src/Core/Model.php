<?php

namespace Core;


use PDO;

abstract class Model
{
    /** @var PDO */
    private static $db;

    protected static function getDB()
    {
        global $config;
        if (self::$db == null) {
            $dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname']
                . ';charset=' . $config['database']['charset'];
            self::$db = new PDO($dsn, $config['database']['username'], $config['database']['password']);

            // Throw an Exception when an error occurs
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }
}