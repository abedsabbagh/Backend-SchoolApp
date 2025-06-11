<?php
class DB {
    private static $conn;
    public static function connect() {
        if (!self::$conn) {
            $dsn = "mysql:host=localhost;dbname=school_app;charset=utf8mb4";
            self::$conn = new PDO($dsn, "root", "");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
}
