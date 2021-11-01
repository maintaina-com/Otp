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
 * An OtpType implementing a static secret
 *
 * The static secret is independent of user and scope.
 * Use cases:
 * - simple mock for integration development
 * - Passcode of the Day rotated by external means  
 */
class StaticSecret implements OtpType
{
    /**
     * A human readable name
     * 
     * @return string
     */
    public static function name(): string
    {
        // TODO: Translation
        return 'Static global secret';
    }

    public function jsonSerialize()
    {
        return [];
    }
    public static function fromJson(string $json): self
    {
        $params = json_decode($json);
        return self::fromParams($params);
    }

    public static function fromParams(object $params): self
    {
        return new self;
    }

}