<?php
declare(strict_types=1);
namespace Horde\Otp;
use InvalidArgumentException;
class SecretGenerator {
    public static function generateRandomSecret(int $length = 8): string
    {
        if ($length % 8 !== 0) {
            throw new InvalidArgumentException('Secret length must be multiple of 8');
        }
        return random_bytes($length);
    }
}