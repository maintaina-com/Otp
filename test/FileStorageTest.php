<?php
namespace Horde\Otp\Test;
use \PHPUnit\Framework\TestCase;
use \Horde\Otp\FileStorage;
/**
 * @author     Ralf Lang <lang@b1-systems.de>
 * @license    http://www.horde.org/licenses/lgpl LGPL
 * @category   Horde
 * @package    Otp
 * @subpackage UnitTests
 */
class FileStorageTest extends TestCase
{
    private FileStorage $storage;
    private string $workDir;
    public function setUp(): void
    {
        $this->workDir = __DIR__. '/workdir';
        $this->storage = new FileStorage($this->workDir);
    }
    public function testFileStorage()
    {
        $this->assertInstanceOf(FileStorage::class, $this->storage);
    }
    public function testSaveAndRetrieve()
    {
        $setup = json_encode(['key' => 'value']);
        $this->storage->saveSetup('user1', 'login', $setup);
        $this->assertFileExists($this->workDir . '/otp-dXNlcjFsb2dpbg==.json');
        $retrievedSetup = json_decode($this->storage->getSetup('user1', 'login'));
        $this->assertIsObject($retrievedSetup);
        $this->assertObjectHasAttribute('key', $retrievedSetup);
    }

    public function testSaveAndRetrieveMultiple()
    {
        $setups = [
            'user1' => [
                'scope1' => json_encode(['key' => 'value', 'scope' => 'scope1']),
                'scopeLogin' => json_encode(['driver' => 'totp', 'scope' => 'scopeLogin'])
            ],
            'user2' => [
                'Billing' => json_encode(['algorithm' => 'sha1', 'scope' => 'Billing'])
            ]
        ];
        foreach ($setups as $subject => $data)
        {
            foreach ($data as $scope => $json) {
                $this->storage->saveSetup($subject, $scope, $json);
            }
        }

        foreach ($setups as $subject => $data)
        {
            foreach ($data as $scope => $json) {
                $retrieved = json_decode($this->storage->getSetup($subject, $scope));
                $this->assertEquals($scope, $retrieved->scope);
            }
        }
    }
    public function tearDown(): void
    {
       array_map('unlink', glob($this->workDir . '/*.json'));
    }
}