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
    public function setUp(): void
    {
        $this->storage = new FileStorage(__DIR__. '/workdir');
    }
    public function testFileStorage()
    {
        $this->assertInstanceOf(FileStorage::class, $this->storage);
    }
    public function testSaveAndRetrieve()
    {
        $setup = json_encode(['key' => 'value']);
        $this->storage->saveSetup('user1', 'login', $setup);
        $this->assertFileExists(__DIR__ . '/workdir/otp-dXNlcjFsb2dpbg==.json');
        $retrievedSetup = json_decode($this->storage->getSetup('user1', 'login'));
        $this->assertIsObject($retrievedSetup);
        $this->assertObjectHasAttribute('key', $retrievedSetup);
    }
}