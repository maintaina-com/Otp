<?php
namespace Horde\Otp\Test;
use \PHPUnit\Framework\TestCase;
use \Horde\Otp\Facade;
/**
 * @author     Ralf Lang <lang@b1-systems.de>
 * @license    http://www.horde.org/licenses/lgpl LGPL
 * @category   Horde
 * @package    Otp
 * @subpackage UnitTests
 */
class FacadeTest extends TestCase
{
    public function testFacade()
    {
        $this->assertInstanceOf(Facade::class, new Facade, 'Primitive instanceof test to ensure test framework works');
    }
}