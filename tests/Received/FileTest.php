<?php
namespace MrPrompt\Centercob\Tests\Received;

use DateTime;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use MrPrompt\Centercob\Tests\Mock;
use MrPrompt\Centercob\Received\File;
use MrPrompt\ShipmentCommon\Base\Cart;
use MrPrompt\Centercob\Received\Partial\Footer;
use MrPrompt\Centercob\Received\Partial\Header;
use MrPrompt\ShipmentCommon\Util\ChangeProtectedAttribute;

/**
 * Signup test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class FileTest extends TestCase
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
    private $signup;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->signup = new File(
            $this->customerMock(),
            (new DateTime('2015-05-19 18:54:42')),
            __DIR__ . '/resources'
        );
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->signup = null;

        parent::tearDown();
    }

    /**
     * @test
     */
    public function readFile()
    {
        $result = $this->signup->getAll();

        $this->assertTrue(is_array($result));
        $this->assertInstanceOf(Header::class, $result[0]);
        $this->assertInstanceOf(Cart::class, $result[1]);
        $this->assertInstanceOf(Footer::class, $result[2]);
    }
}
