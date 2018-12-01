<?php
namespace MrPrompt\Centercob\Tests\Shipment\Partial;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use MrPrompt\Centercob\Shipment\Partial\Footer;
use MrPrompt\Centercob\Tests\Mock as CentercobMock;
use MrPrompt\ShipmentCommon\Util\ChangeProtectedAttribute;

/**
 * Footer test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class FooterTest extends TestCase
{
    /**
     * @see \Centercob\Common\Util\ChangeProtectedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @see \Centercob\Tests\Gateway\Mock
     */
    use CentercobMock;

    /**
     * Footer object
     *
     * @var Footer
     */
    private $footer;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->footer = new Footer(1, 1, $this->sequenceMock());
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->footer = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Footer::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Footer::render()
     * @covers \MrPrompt\ShipmentCommon\Base\Sequence::getValue()
     */
    public function renderReturnExactLength()
    {
        $this->assertEquals(1006, strlen($this->footer->render()));
    }
}
