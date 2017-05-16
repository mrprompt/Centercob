<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use MrPrompt\Centercob\Common\Base\Parcel;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use DateTime;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Parcel test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class ParcelTest extends TestCase
{
    /**
     * @see \Centercob\Tests\ChangeProctedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Parcel
     */
    private $parcel;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->parcel = new Parcel();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->parcel = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::getMaturity()
     */
    public function getMaturity()
    {
        $maturity = new DateTime();

        $this->modifyAttribute($this->parcel, 'maturity', $maturity);

        $this->assertSame($maturity, $this->parcel->getMaturity());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::setMaturity()
     */
    public function setMaturity()
    {
        $result = $this->parcel->setMaturity(new DateTime());

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::getPrice()
     */
    public function getPrice()
    {
        $price = 1.00;

        $this->modifyAttribute($this->parcel, 'price', $price);

        $this->assertEquals($price, $this->parcel->getPrice());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::setPrice()
     */
    public function setPrice()
    {
        $result = $this->parcel->setPrice(1);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::setPrice()
     * @expectedException \InvalidArgumentException
     */
    public function setPriceThrowsExceptionWhenReceiveNotNumericValue()
    {
        $this->parcel->setPrice('SD');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::setPrice()
     * @expectedException \InvalidArgumentException
     */
    public function setPriceThrowsExceptionWhenReceiveEmptyValue()
    {
        $this->parcel->setPrice('');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::getKey()
     */
    public function getKey()
    {
        $parcel = 1;

        $this->modifyAttribute($this->parcel, 'key', $parcel);

        $this->assertEquals($parcel, $this->parcel->getKey());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::setKey()
     */
    public function setKey()
    {
        $result = $this->parcel->setKey(1);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::setKey()
     * @expectedException \InvalidArgumentException
     */
    public function setKeyThrowsExceptionWhenReceiveNotNumericValue()
    {
        $this->parcel->setKey('SD');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::getQuantity()
     */
    public function getQuantity()
    {
        $quantity = 1.00;

        $this->modifyAttribute($this->parcel, 'quantity', $quantity);

        $this->assertEquals($quantity, $this->parcel->getQuantity());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::setQuantity()
     */
    public function setQuantity()
    {
        $result = $this->parcel->setQuantity(1);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::setQuantity()
     * @expectedException \InvalidArgumentException
     */
    public function setQuantityThrowsExceptionWhenReceiveNotNumericValue()
    {
        $this->parcel->setQuantity('SD');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Parcel::setQuantity()
     * @expectedException \InvalidArgumentException
     */
    public function setQuantityThrowsExceptionWhenReceiveEmptyValue()
    {
        $this->parcel->setQuantity('');
    }
}
