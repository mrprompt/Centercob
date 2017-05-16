<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use MrPrompt\Centercob\Common\Base\Customer;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;

/**
 * Customer test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CustomerTest extends TestCase
{
    /**
     * @see \Centercob\Common\Util\ChangeProtectedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->customer = new Customer();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->customer = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::getCode()
     */
    public function getCodeReturnCodeAttribute()
    {
        $this->modifyAttribute($this->customer, 'code', 1);

        $this->assertEquals($this->customer->getCode(), 1);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setCode()
     */
    public function setCodeMustBeReturnNullWhenReceiveIntegerValue()
    {
        $this->assertNull($this->customer->setCode(1));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setCode()
     */
    public function setCodeMustBeReturnNullWhenReceiveNotNumericValue()
    {
        $this->assertNull($this->customer->setCode('A'));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setCode()
     * @expectedException \InvalidArgumentException
     */
    public function setCodeOnlyThrowsExceptionWhenEmpty()
    {
        $this->customer->setCode('');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setCode()
     */
    public function setCodeMustBeReturnNullWhenReceiveFloatValue()
    {
        $this->assertNull($this->customer->setCode(7.9837));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::getIdentityNumber()
     */
    public function getIdentityNumberReturnIdentityNumberAttribute()
    {
        $this->modifyAttribute($this->customer, 'identityNumber', 1);

        $this->assertEquals($this->customer->getIdentityNumber(), 1);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setIdentityNumber()
     */
    public function setIdentityNumberReturnNullWhenReceiveNumericValue()
    {
        $this->assertNull($this->customer->setIdentityNumber(1));
        $this->assertNull($this->customer->setIdentityNumber(1.5));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setIdentityNumber()
     * @expectedException \InvalidArgumentException
     */
    public function setIdentityNumberThrowsExceptionWhenNotNumericValue()
    {
        $this->customer->setIdentityNumber('A');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setIdentityNumber()
     * @expectedException \InvalidArgumentException
     */
    public function setIdentityNumberThrowsExceptionWhenEmpty()
    {
        $this->customer->setIdentityNumber('');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::getWorkingDays()
     */
    public function getWorkingDaysReturnWorkingDaysAttribute()
    {
        $this->modifyAttribute($this->customer, 'workingDays', 1);

        $this->assertEquals($this->customer->getWorkingDays(), 1);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setWorkingDays()
     */
    public function setWorkingDaysReturnNullWhenReceiveNumericValue()
    {
        $this->assertNull($this->customer->setWorkingDays(1));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setWorkingDays()
     * @expectedException \InvalidArgumentException
     */
    public function setWorkingDaysThrowsExceptionWhenNotNumericValue()
    {
        $this->customer->setWorkingDays('A');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setWorkingDays()
     * @expectedException \InvalidArgumentException
     */
    public function setWorkingDaysThrowsExceptionWhenEmpty()
    {
        $this->customer->setWorkingDays('');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setWorkingDays()
     * @expectedException \InvalidArgumentException
     */
    public function setWorkingDaysThrowsExceptionWhenNotInteger()
    {
        $this->customer->setWorkingDays(5.43);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::getHelpfulMaturity()
     */
    public function getHelpfulMaturityReturnHelpfulMaturityAttribute()
    {
        $this->modifyAttribute($this->customer, 'helpfulMaturity', true);

        $this->assertTrue($this->customer->getHelpfulMaturity());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setHelpfulMaturity()
     */
    public function setHelpfulMaturityReturnNullWhenReceiveBooleanValue()
    {
        $this->assertNull($this->customer->setHelpfulMaturity(true));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setHelpfulMaturity()
     * @expectedException \InvalidArgumentException
     */
    public function setHelpfulMaturityThrowsExceptionWhenNotBooleanValue()
    {
        $this->customer->setHelpfulMaturity('A');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setHelpfulMaturity()
     * @expectedException \InvalidArgumentException
     */
    public function setHelpfulMaturityThrowsExceptionWhenReceiveEmpty()
    {
        $this->customer->setHelpfulMaturity('');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Customer::setHelpfulMaturity()
     * @expectedException \InvalidArgumentException
     */
    public function setHelpfulMaturityThrowsExceptionWhenNumeric()
    {
        $this->customer->setHelpfulMaturity(5.43);
    }
}
