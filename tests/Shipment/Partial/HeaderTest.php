<?php
namespace MrPrompt\Centercob\Tests\Shipment\Partial;

use DateTime;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use MrPrompt\Centercob\Shipment\Partial\Header;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use MrPrompt\Centercob\Tests\Mock as CentercobMock;
use MrPrompt\Centercob\Common\Base\Customer;
use MrPrompt\Centercob\Common\Base\Sequence;

/**
 * Header test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class HeaderTest extends TestCase
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
     * Header
     *
     * @var Header
     */
    private $header;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->header = new Header(
            $this->customerMock(),
            $this->sequenceMock(),
            new DateTime()
        );
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->header = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::getCustomer()
     */
    public function getCustomerMustBeReturnCustomerAttribute()
    {
        $this->assertInstanceOf(Customer::class, $this->header->getCustomer());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::setCustomer()
     */
    public function setCustomerMustBeReturnCustomerAttribute()
    {
        $customer = new Customer();

        $result   = $this->header->setCustomer($customer);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::getCreated()
     */
    public function getCreatedMustBeReturnCreatedAttribute()
    {
        $this->assertInstanceOf(DateTime::class, $this->header->getCreated());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::setCreated()
     */
    public function setCreatedMustBeReturnCreatedAttribute()
    {
        $Created = new DateTime();

        $result   = $this->header->setCreated($Created);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::getSequence()
     */
    public function getSequenceMustBeReturnSequenceAttribute()
    {
        $this->assertInstanceOf(Sequence::class, $this->header->getSequence());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::setSequence()
     */
    public function setSequenceMustBeReturnSequenceAttribute()
    {
        $Sequence = new Sequence();

        $result   = $this->header->setSequence($Sequence);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Header::render()
     */
    public function renderReturnExactLength()
    {
        $this->assertEquals(1006, strlen($this->header->render()));
    }
}
