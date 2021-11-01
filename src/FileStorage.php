<?php
declare(strict_types=1);
namespace Horde\Otp;

class FileStorage implements Storage
{
    private string $storageDir;

    public function __construct(string $storageDir)
    {
        $this->storageDir = realpath($storageDir);
    }

    public function getSetup(string $subject, string $scope): string
    {
        return file_get_contents($this->filename($subject, $scope));
    }

    public function saveSetup(
        string $subject,
        string $scope,
        string $setup
    ): void
    {
        $file = $this->filename($subject, $scope);
        file_put_contents($file, $setup);
    }

    /**
     * Generate a filename in storageDir
     * 
     * The subject name and scope are base64-encoded to allow characters which
     * may be illegal in filesystems or pose a security risk
     *
     * @param string $subject
     * @param string $scope
     * 
     * @return string
     */
    private function filename(string $subject, string $scope): string
    {
        return $this->storageDir . 
        '/otp-' . base64_encode($subject . $scope) . 
        '.json';
    }
}