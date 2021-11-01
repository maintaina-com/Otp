<?php
declare(strict_types=1);
namespace Horde\Otp;

interface Storage
{
    public function getSetup(string $subject, string $scope): string;
    public function saveSetup(string $subject, string $scope, string $setup): void;
}