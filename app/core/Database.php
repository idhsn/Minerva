<?php

namespace App\Core;

use PDO;

class Database
{
    private static $pdo = null;

    public static function connection()
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../../config/config.php';
            $db = $config['db'];
            self::$pdo = new PDO($db['dsn'], $db['user'], $db['pass'], $db['options']);
        }

        return self::$pdo;
    }
}
