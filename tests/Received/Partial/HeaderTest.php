<?php
namespace MrPrompt\Centercob\Tests\Received\Partial;

use DateTime;
use PHPUnit\Framework\TestCase;
use MrPrompt\Centercob\Tests\Mock;
use MrPrompt\ShipmentCommon\Base\Customer;
use MrPrompt\ShipmentCommon\Base\Sequence;
use MrPrompt\Centercob\Received\Partial\Header;
use MrPrompt\ShipmentCommon\Util\ChangeProtectedAttribute;

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
    use Mock;

    /**
     * @var Header
     */
    private $header;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $file = file_get_contents(__DIR__ . '/../resources/RET0000759-19.05.2015-18.54.42.TXT');
        $rows = explode(PHP_EOL, $file);

        $this->header = new Header(array_shift($rows));
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
     * @covers \MrPrompt\Centercob\Received\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Header::getCustomer()
     */
    public function getCustomerMustBeReturnCustomerInstance()
    {
        $customer = $this->header->getCustomer();

        $this->assertInstanceOf(Customer::class, $customer);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Header::setCustomer()
     */
    public function setCustomerMustBeReturnNull()
    {
        $result = $this->header->setCustomer($this->customerMock());

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Header::getCreated()
     */
    public function getCreatedMustBeReturnDateTimeInstance()
    {
        $created = $this->header->getCreated();

        $this->assertInstanceOf(DateTime::class, $created);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Header::setCreated()
     */
    public function setCreatedMustBeReturnNull()
    {
        $result = $this->header->setCreated(new DateTime());

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Header::getSequence()
     */
    public function getSequenceMustBeReturnSequenceInstance()
    {
        $sequence = $this->header->getSequence();

        $this->assertInstanceOf(Sequence::class, $sequence);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Header::setSequence()
     */
    public function setSequenceMustBeReturnNull()
    {
        $result = $this->header->setSequence($this->sequenceMock());

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Header::getPassed()
     */
    public function getPassedMustBeReturnPassedInstance()
    {
        $passed = $this->header->getPassed();

        $this->assertNotEmpty($passed);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Header::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Header::setPassed()
     */
    public function setPassedMustBeReturnNull()
    {
        $result = $this->header->setPassed('SIM');

        $this->assertNull($result);
    }
}
