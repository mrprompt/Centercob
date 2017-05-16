<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use MrPrompt\Centercob\Common\Base\Cart;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use MrPrompt\Centercob\Gateway\Shipment\Partial\Detail;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Cart test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CartTest extends TestCase
{
    /**
     * @see \Centercob\Tests\ChangeProctedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $item   = m::mock(Detail::class);

        $this->cart = new Cart([$item]);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->cart = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Cart::addItem()
     */
    public function addItem()
    {
        $item   = m::mock(Detail::class);

        $result = $this->cart->addItem($item);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Cart::removeItem()
     */
    public function removeItem()
    {
        $item   = 0;
        $result = $this->cart->removeItem($item);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Cart::removeItem()
     * @expectedException \InvalidArgumentException
     */
    public function removeItemAbsentThrowsException()
    {
        $item  = 1;
        $result = $this->cart->removeItem($item);

        $this->assertNull($result);
    }
}
