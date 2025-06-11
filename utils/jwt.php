<?php
require_once __DIR__.'/../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token {
    private static $KEY = "SCHOOL_SECRET";
    private static $ALG = "HS256";
    public static function generate(array $payload): string {
        return JWT::encode(
            $payload + ['iat'=>time(),'exp'=>time()+60*60*12],
            self::$KEY, self::$ALG);
    }
    public static function verify(string $jwt) {
        return JWT::decode($jwt, new Key(self::$KEY, self::$ALG));
    }
}
