<?php

namespace Config {

    use PDO;
    use PDOException;

    class Database
    {
        private static $connection;
        private static $connectionCount = 0;

        public static function getConnection(): PDO
        {
            if (self::$connection === null) {
                try {
                    $dsn = "mysql:host=localhost;port=3306;dbname=api_php_todo";
                    $username = 'root';
                    $password = '';

                    self::$connection = new PDO($dsn, $username, $password);
                    self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    self::$connectionCount++;
                } catch (PDOException $exception) {
                    error_log('Database connection failed: ' . $exception->getMessage());
                    self::$connection = null;
                }
            }

            return self::$connection;
        }

        public static function getConnectionCount()
        {
            return self::$connectionCount;
        }

        public static function closeConnection()
        {
            self::$connection = null;
            self::$connectionCount--;
        }
    }
}
