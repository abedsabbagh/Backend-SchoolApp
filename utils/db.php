
<?php

class DB
{
    public static function connect(): PDO
    {
        $host = getenv('SCHOOLAPP_DB_HOST') ?: '127.0.0.1';
        $name = getenv('SCHOOLAPP_DB_NAME') ?: 'school_app';

        $user = getenv('SCHOOLAPP_DB_USER');
        $pass = getenv('SCHOOLAPP_DB_PASSWORD');

        if ($user === false || $pass === false) {
            throw new RuntimeException(
                'Database credentials are not configured.'
            );
        }

        try {
            return new PDO(
                "mysql:host=$host;dbname=$name;charset=utf8mb4",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            error_log($e->getMessage());

            throw new RuntimeException(
                'Database connection failed.'
            );
        }
    }
}
