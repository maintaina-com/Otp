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
use JsonSerializable;

/**
 * Interface of an OTP Type Definition
 * 
 */
interface OtpType extends JsonSerializable
{
    /**
     * A human readable name
     * 
     * @return string
     */
    public static function name(): string;
 
    /**
     * Construct from a JSON string with parameters
     *
     * @param string $json
     * @return self
     */
    public static function fromJson(string $json): self;

    /**
     * Construct from a plain object with parameters
     *
     * @param object $params
     * @return void
     */
    public static function fromParams(object $params): self;

}