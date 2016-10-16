<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use MrPrompt\Centercob\Common\Base\Dealership;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use Mockery as m;
use PHPUnit_Framework_TestCase;

/**
 * Dealership test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class DealershipTest extends PHPUnit_Framework_TestCase
{
    /**
     * @see \Centercob\Tests\ChangeProctedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Dealership
     */
    private $dealership;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->dealership = new Dealership();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Dealership::getCode()
     */
    public function getCodeReturnCodeAttribute()
    {
        $this->modifyAttribute($this->dealership, 'code', 1);

        $this->assertEquals(1, $this->dealership->getCode());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Dealership::setCode()
     */
    public function setCodeMustBeReturnNull()
    {
        $this->assertNull($this->dealership->setCode('1'));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Dealership::setCode()
     * @expectedException \InvalidArgumentException
     */
    public function setCodeThrowsExceptionWhenExceedMaxLengh()
    {
        $this->assertNull($this->dealership->setCode('999999999'));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Dealership::getName()
     */
    public function getNameReturnNameAttribute()
    {
        $this->modifyAttribute($this->dealership, 'name', 1);

        $this->assertEquals(1, $this->dealership->getName());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Dealership::setName()
     */
    public function setNameMustBeReturnNull()
    {
        $this->assertNull($this->dealership->setName('1'));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Dealership::setName()
     * @expectedException \InvalidArgumentException
     */
    public function setNameThrowsExceptionWhenEmpty()
    {
        $this->assertNull($this->dealership->setName(''));
    }
}
