<?php
declare(strict_types=1);
namespace Horde\Otp;
use Horde_Date;
use \InvalidArgumentException;
/**
 * A trait with shared implementation code for TOTP and HOTP
 */
trait OtpCalculationTrait
{
    private int $startTime;
    private string $algorithm;
    private int $window;
    // Parameters:
    // Secret
    // Window size (30, 60)
    // Algo sha256 vs sha512 vs sha1
    // startTime (usually 0)
    // key
    // Grace windows
    // Digits of the OTP (6)
    public function calculateSerial(Horde_Date $dt, int $digits = 6): int
    {
        $unixTs = $dt->timestamp();
        // Calculate the count
        $adjusted = $unixTs - $this->startTime;
        $count = (int) floor($adjusted / $this->window);
        return $count;
    }

    public function padSecret(string $secret): string
    {
        // TODO: Validate Secret
        if ($this->algorithm === 'sha256') {
            $secret = $secret . substr($secret, 0, 12);
        } elseif ($this->algorithm === 'sha512') {
            $secret = str_repeat($secret, 3) . substr($secret, 0, 4);
        }
        return $secret;
    }

    public function generateRandomSecret(int $length = 8): string
    {
        if ($length % 8 !== 0) {
            throw new InvalidArgumentException('Secret length must be multiple of 8');
        }
        return random_bytes($length);
    }

    public function generateHotp(string $secret, int $count, int $length = 6): string
    {
        $packedString = $this->packCounter($count);
        $hashed = hash_hmac($this->algorithm, $packedString, $secret);
        $hotpValueString = $this->buildHOTPValue($hashed, $length);

        $paddedHotpString = str_pad($hotpValueString, $length, '0', STR_PAD_LEFT);
        return substr($paddedHotpString, (-1 * $length));
    }


    private function buildHotpValue(string $hashed, int $length): string
    {
        /**
         * @var int[]
         */
        $hmacIntList = [];
        // Hex to Dec
        foreach (str_split($hashed, 2) as $hex) {
            $hmacIntList[] = (int) hexdec($hex);
        }

        $offset = (int)$hmacIntList[count($hmacIntList) - 1] & 0xf;

        $code = (int)($hmacIntList[$offset] & 0x7f) << 24
            | ($hmacIntList[$offset + 1] & 0xff) << 16
            | ($hmacIntList[$offset + 2] & 0xff) << 8
            | ($hmacIntList[$offset + 3] & 0xff);

        // Expand
        return (string) ($code % 10 ** $length);
    }


    /**
     * Pack the counter to a binary string of 8 chars
     *
     * @param int $counter
     * @return string
     */
    public function packCounter(int $counter): string
    {
        $counterField = array_fill(0, 8, 0);
        for ($i = 7; $i >= 0; $i--) {
            $counterField[$i] = pack('C*', $counter);
            $counter = $counter >> 8;
        }
        $counterBin = implode($counterField);
        if (strlen($counterBin) < 8) {
            $counterBin = str_repeat(chr(0), 8 - strlen($counterBin)) . $counterBin;
        }
        return $counterBin;
    }

}