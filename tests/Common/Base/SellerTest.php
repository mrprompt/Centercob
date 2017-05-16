<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use MrPrompt\Centercob\Common\Base\Seller;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Seller test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class SellerTest extends TestCase
{
    /**
     * @see \Centercob\Tests\ChangeProctedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Seller
     */
    private $seller;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->seller = new Seller();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->seller = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Seller::getCode()
     */
    public function getCodeReturnCodeAttribute()
    {
        $this->modifyAttribute($this->seller, 'code', 1);

        $this->assertEquals($this->seller->getCode(), 1);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Seller::setCode()
     */
    public function setCodeChangeCodeAttribute()
    {
        $this->seller->setCode(1);

        $this->assertEquals($this->seller->getCode(), 1);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Seller::setCode()
     * @expectedException \InvalidArgumentException
     */
    public function setCodeMustBeThrowsInvalidArgumentExceptionWhenEmpty()
    {
        $this->seller->setCode('');
    }
}
