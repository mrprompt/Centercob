<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use MrPrompt\Centercob\Common\Base\Holder;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;

/**
 * Holder test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class HolderTest extends TestCase
{
    /**
     * @see \Centercob\Common\Util\ChangeProtectedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Holder
     */
    private $holder;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->holder = new Holder();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->holder = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Holder::getCode()
     */
    public function getCodeReturnCodeAttribute()
    {
        $this->modifyAttribute($this->holder, 'code', 1);

        $this->assertEquals($this->holder->getCode(), 1);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Holder::setCode()
     */
    public function setCodeMustBeReturnNullWhenReceiveIntegerValue()
    {
        $this->assertNull($this->holder->setCode(1));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Holder::setCode()
     * @expectedException \InvalidArgumentException
     */
    public function setCodeThrowsExceptionWhenNotNumericValue()
    {
        $this->holder->setCode('A');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Holder::setCode()
     * @expectedException \InvalidArgumentException
     */
    public function setCodeOnlyThrowsExceptionWhenEmpty()
    {
        $this->holder->setCode('');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Holder::setCode()
     * @expectedException \InvalidArgumentException
     */
    public function setCodeOnlyThrowsExceptionWhenNotIntegerValue()
    {
        $this->holder->setCode(7.9837);
    }
}
