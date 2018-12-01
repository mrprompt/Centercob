<?php
namespace MrPrompt\Centercob\Tests\Shipment;

use DateTime;
use Mockery as m;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use MrPrompt\Centercob\Tests\Mock;
use MrPrompt\Centercob\Shipment\File;
use MrPrompt\ShipmentCommon\Base\Cart;
use MrPrompt\ShipmentCommon\Base\Sequence;
use MrPrompt\Centercob\Shipment\Partial\Footer;
use MrPrompt\Centercob\Shipment\Partial\Header;
use MrPrompt\ShipmentCommon\Util\ChangeProtectedAttribute;

/**
 * file test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class FileTest extends TestCase
{
    /**
     * @see \MrPrompt\ShipmentCommon\Util\ChangeProtectedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @see \MrPrompt\Centercob\Tests\Mock
     */
    use Mock;

    /**
     * @var File
     */
    private $file;

    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    private static $root;

    /**
     * Boostrap
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        self::$root = vfsStream::setup();
    }

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
            self::$root->url()
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
     * @covers \MrPrompt\Centercob\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Shipment\File::getCart()
     */
    public function getCartMustBeReturnCartAttribute()
    {
        $cart = new Cart();

        $this->modifyAttribute($this->file, 'cart', $cart);

        $this->assertSame($cart, $this->file->getCart());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Shipment\File::setCart()
     */
    public function setCartMustBeReturnCartAttribute()
    {
        $cart   = new Cart;
        $result = $this->file->setCart($cart);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Shipment\File::getFooter()
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
     * @covers \MrPrompt\Centercob\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Shipment\File::setFooter()
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
     * @covers \MrPrompt\Centercob\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Shipment\File::getHeader()
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
     * @covers \MrPrompt\Centercob\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Shipment\File::setHeader()
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
     * @covers \MrPrompt\Centercob\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Shipment\File::save()
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
     * @covers \MrPrompt\Centercob\Shipment\File::__construct()
     * @covers \MrPrompt\Centercob\Shipment\File::read()
     */
    public function read()
    {
        $result = $this->file->read();

        $this->assertTrue(is_array($result));
        $this->assertInstanceOf(Header::class, $result[0]);
        $this->assertInstanceOf(Cart::class, $result[1]);
        $this->assertInstanceOf(Footer::class, $result[2]);
    }
}
