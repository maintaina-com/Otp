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
     * Check if a subject has opted in to OTP usage
     * 
     * Usage is defined for a given scope and subject
     * A subject may be a user or another kind of client
     * A scope may be "login" or a specific area of the application
     *
     * @param string $subject
     * @param string $scope
     * @return boolean
     */
    public function checkHasOtpSetup(string $subject, string $scope = 'default'): bool
    {
        return true;
    }

    public function checkMustUseOtp(string $subject, string $scope = 'default'): bool
    {
        return true;
    }

    public function resetOtpSetup(string $subject, string $scope = 'default'): void
    {
        // clear a subject's OTP configuration
    }

    /**
     * Validate a user input
     *
     * @param string $passcode 
     * @param string $subject
     * @param string $scope
     * @param Horde_Date|null $when
     * @return bool
     */
    public function validatePasscode(string $passcode, string $subject, string $scope = 'default', Horde_Date $when = null)
    {
        // Generate horde_date for UTC/now if not provided
        // Get the appropriate config from the storage backend
        // Create the corresponding driver and setup
        // Delegate to the appropriate driver
        // The driver has to handle grace periods etc
        // Commit last successful login to the storage backend
        // TODO: Also commit last unsuccessful logins?
    }
}