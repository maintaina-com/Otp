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
use Horde_Date;
/**
 * Interface of an OTP Type Definition
 * 
 */
interface OtpType
{
    /**
     * A human readable name
     * 
     * @return string
     */
    public static function name(): string;
}