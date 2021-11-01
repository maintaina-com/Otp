<?php
/**
 * Copyright 2021-2022 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (BSD). If you
 * did not receive this file, see http://www.horde.org/licenses/bsd.
 *
 * @author   Ralf Lang <lang@b1-systems.de>
 * @category Horde
 * @license  http://www.horde.org/licenses/lgpl LPGL
 * @package  Horde\Otp
 */
declare(strict_types=1);
namespace Horde\Otp;

use \InvalidArgumentException;
use \Horde_Date;
/**
 * TOTP (RFC 6238)
 *
 * 
 */
class Totp implements OtpType
{
    use OtpCalculationTrait;
    private string $secret;
    private int $grace;
    private int $digits;
    const SUPPORTED_ALGORITHMS = ['sha1', 'sha256', 'sha512'];

    public function __construct(string $algorithm, int $digits, int $startTime, int $window, int $grace)
    {
        if (!in_array($algorithm, self::SUPPORTED_ALGORITHMS)) {
            throw new InvalidArgumentException("Invalid Algorithm: $algorithm");
        }
        $this->algorithm = $algorithm;
        $this->digits = $digits;
        $this->startTime = $startTime;
        $this->window = $window;
        $this->grace = $grace;
    }

    /**
     * A human readable name
     * 
     * @return string
     */
    public static function name(): string
    {
        // TODO: Translation
        return 'TOTP: Time-Based One-Time Password Algorithm';
    }

}