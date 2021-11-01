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
/**
 * HOTP (RFC 6238)
 */
class Hotp implements OtpType
{
    const SUPPORTED_ALGORITHMS = ['sha1', 'sha256', 'sha512'];
    use OtpCalculationTrait;
    /**
     * A human readable name
     * 
     * @return string
     */
    public static function name(): string
    {
        // TODO: Translation
        return 'HOTP: HMAC-Based One-Time Password Algorithm';
    }
}