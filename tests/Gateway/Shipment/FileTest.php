<?php
namespace MrPrompt\Centercob\Tests\Gateway\Shipment;

use MrPrompt\Centercob\Common\Base\Cart;
use DateTime;
use Mockery as m;
use PHPUnit_Framework_TestCase;
use MrPrompt\Centercob\Gateway\Shipment\File;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use MrPrompt\Centercob\Tests\Gateway\Mock;
use MrPrompt\Centercob\Gateway\Shipment\Partial\Footer;
use MrPrompt\Centercob\Gateway\Shipment\Partial\Header;
use MrPrompt\Centercob\Common\Base\Sequence;

/**
 * file test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class FileTest extends PHPUnit_Framework_TestCase
{
    /**
     * @see \Centercob\Common\Util\ChangeProtectedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @see \Centercob\Tests\Gateway\Mock
     */
    use Mock;

    /**
     * @var File
     */
    private $file;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->file = new File(
            $this->customerMock(),
            $this->sequenceMock(),
            new DateTime,
            __DIR__
        );
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->file = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::getCart()
     */
    public function getCartMustBeReturnCartAttribute()
    {
        $cart = new Cart();

        $this->modifyAttribute($this->file, 'cart', $cart);

        $this->assertSame($cart, $this->file->getCart());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::setCart()
     */
    public function setCartMustBeReturnCartAttribute()
    {
        $cart   = new Cart;
        $result = $this->file->setCart($cart);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::getFooter()
     */
    public function getFooterMustBeReturnFooterAttribute()
    {
        $sequence   = new Sequence();
        $footer     = new Footer(0, 0, $sequence);

        $this->modifyAttribute($this->file, 'footer', $footer);

        $this->assertSame($footer, $this->file->getFooter());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::setFooter()
     */
    public function setFooterMustBeReturnFooterAttribute()
    {
        $sequence   = new Sequence();

        $footer     = new Footer(0, 0, $sequence);

        $result     = $this->file->setFooter($footer);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::getHeader()
     */
    public function getHeaderMustBeReturnHeaderAttribute()
    {
        $header     = new Header(
            $this->customerMock(),
            $this->sequenceMock(),
            new DateTime()
        );

        $this->modifyAttribute($this->file, 'header', $header);

        $this->assertSame($header, $this->file->getHeader());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::setHeader()
     */
    public function setHeaderMustBeReturnHeaderAttribute()
    {
        $header     = new Header(
            $this->customerMock(),
            $this->sequenceMock(),
            new DateTime()
        );

        $result     = $this->file->setHeader($header);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::save()
     */
    public function save()
    {
        $this->modifyAttribute($this->file, 'cart', new \ArrayObject());
        
        $output = $this->file->save();

        $this->assertFileExists($output);
    }

    /**
     * @test
     * @depends save
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\File::read()
     */
    public function read()
    {
        $result = $this->file->read();

        $this->assertTrue(is_array($result));
        $this->assertInstanceOf(Header::class, $result[0]);
        $this->assertInstanceOf(Cart::class, $result[1]);
        $this->assertInstanceOf(Footer::class, $result[2]);

        // cleanup temp files
        array_map('unlink', glob(__DIR__ . DIRECTORY_SEPARATOR . '*.TXT'));
    }
}
