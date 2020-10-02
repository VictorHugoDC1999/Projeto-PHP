<?php

namespace Victor\Database;

use PDO;

abstract class Connection {

    private static $conn;

    public static function getConn() {

        if (!isset(self::$conn)) {//se não existir
            self::$conn = new \PDO('mysql: 
                host=localhost;
                dbname=user_login',
                'root',
                '');
        }

        return self::$conn;
    }
}