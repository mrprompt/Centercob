<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use MrPrompt\Centercob\Common\Base\Bank;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Bank test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class BankTest extends TestCase
{
    /**
     * @see \Centercob\Tests\ChangeProctedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Bank
     */
    private $bank;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->bank = new Bank();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->bank = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::getAgency()
     */
    public function getAgencyReturnAgencyAttribute()
    {
        $agency = 55;

        $this->modifyAttribute($this->bank, 'agency', $agency);

        $this->assertEquals($agency, $this->bank->getAgency());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::setAgency()
     */
    public function setAgencyReturnNull()
    {
        $this->assertNull($this->bank->setAgency(55));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::setAgency()
     * @expectedException \InvalidArgumentException
     */
    public function setAgencyThrowsExceptionWhenNotNumericValue()
    {
        $this->assertNull($this->bank->setAgency('SS'));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::getDigit()
     */
    public function getDigitReturnDigitAttribute()
    {
        $agency = 55;

        $this->modifyAttribute($this->bank, 'digit', $agency);

        $this->assertEquals($agency, $this->bank->getDigit());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::setDigit()
     */
    public function setDigitReturnNull()
    {
        $this->assertNull($this->bank->setDigit(45));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::setDigit()
     * @expectedException \InvalidArgumentException
     */
    public function setDigitThrowsExceptionWhenNotNumericValue()
    {
        $this->assertNull($this->bank->setDigit('AS'));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::getCode()
     */
    public function getCodeMustBeReturnCodeAttribute()
    {
        $this->modifyAttribute($this->bank, 'code', Bank::SICRED);

        $this->assertEquals(Bank::SICRED, $this->bank->getCode());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::setCode()
     */
    public function setCodeMustBeReturnNull()
    {
        $result = $this->bank->setCode(Bank::SICRED);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::setCode()
     * @expectedException \InvalidArgumentException
     */
    public function setCodeMustBeThrowsExceptionWhenReceiveStringName()
    {
        $this->bank->setCode('Banco do Brasil');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Bank::setCode()
     * @expectedException \InvalidArgumentException
     */
    public function setCodeMustBeThrowsExceptionWhenReceiveInvalidCode()
    {
        $this->bank->setCode(0);
    }
}
