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
 * Facade for interacting with the OTP system
 *
 * @author    Ralf Lang <lang@b1-systems.de>
 * @category  Horde
 * @copyright 2021-2022 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Horde\otp
 */
class Facade
{
    public function __construct()
    {
    }

    /**
     * Validate a user input
     *
     * @param string $who The uid whose se
     * @param string $scope
     * @param Horde_Date|null $when
     * @return bool
     */
    public function validateSecret(string $who, string $scope, Horde_Date $when = null)
    {
        return true;
    }
}