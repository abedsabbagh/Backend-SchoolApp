
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token
{
    private static function secret(): string
    {
        $secret = getenv('SCHOOLAPP_JWT_SECRET');

        if ($secret === false || strlen($secret) < 32) {
            throw new RuntimeException(
                'JWT signing secret is not configured.'
            );
        }

        return $secret;
    }

    public static function generate(array $payload): string
    {
        $now = time();

        $payload['iat'] = $now;
        $payload['exp'] = $now + (12 * 60 * 60);

        return JWT::encode(
            $payload,
            self::secret(),
            'HS256'
        );
    }

    public static function verify(string $jwt): stdClass
    {
        return JWT::decode(
            $jwt,
            new Key(self::secret(), 'HS256')
        );
    }
}
