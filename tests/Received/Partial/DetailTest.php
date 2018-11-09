<?php
namespace MrPrompt\Centercob\Tests\Received\Partial;

use PHPUnit\Framework\TestCase;
use MrPrompt\Centercob\Received\Partial\Detail;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use MrPrompt\Centercob\Tests\Mock;
use MrPrompt\Centercob\Common\Base\Authorization;
use MrPrompt\Centercob\Common\Base\Client;
use MrPrompt\Centercob\Common\Base\ConsumerUnity;
use MrPrompt\Centercob\Common\Base\Dealership;
use MrPrompt\Centercob\Common\Base\Occurrence;
use MrPrompt\Centercob\Common\Base\Parcel;
use MrPrompt\Centercob\Common\Base\Purchaser;
use MrPrompt\Centercob\Common\Base\Sequence;

/**
 * Detail test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class DetailTest extends TestCase
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
     * @var Detail
     */
    private $detail;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $file = file_get_contents(__DIR__ . '/../resources/RET0000759-19.05.2015-18.54.42.TXT');
        $rows = explode(PHP_EOL, $file);

        $this->detail = new Detail($rows[1]);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->detail = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::getConsumerUnity()
     */
    public function getConsumerUnityMustBeReturnConsumerUnityObject()
    {
        $unity = $this->detail->getConsumerUnity();

        $this->assertInstanceOf(ConsumerUnity::class, $unity);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::setConsumerUnity()
     */
    public function setConsumerUnityMustNull()
    {
        $unity  = $this->consumerUnityMock();
        $result = $this->detail->setConsumerUnity($unity);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::getOccurrence()
     */
    public function getOccurrenceMustBeReturnOccurrenceObject()
    {
        $occurrence = $this->detail->getOccurrence();

        $this->assertInstanceOf(Occurrence::class, $occurrence);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::setOccurrence()
     */
    public function setOccurrenceMustBeReturnNull()
    {
        $occurrence = $this->occurrenceMock();
        $result     = $this->detail->setOccurrence($occurrence);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::getParcel()
     */
    public function getParcelMustBeReturnParcelObject()
    {
        $parcel = $this->detail->getParcel();

        $this->assertInstanceOf(Parcel::class, $parcel);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::setParcel()
     */
    public function setParcelMustBeReturnParcelObject()
    {
        $parcel = $this->parcelMock();
        $result = $this->detail->setParcel($parcel);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::getAuthorization()
     */
    public function getAuthorizationMustBeReturnAuthorizationObject()
    {
        $authorization = $this->detail->getAuthorization();

        $this->assertInstanceOf(Authorization::class, $authorization);
    }
    
    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::setAuthorization()
     */
    public function setAuthorizationMustBeReturnAuthorizationObject()
    {
        $authorization = $this->authorizationMock();
        $result = $this->detail->setAuthorization($authorization);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::getDealership()
     */
    public function getDealershipMustBeReturnDealershipObject()
    {
        $dealership = $this->detail->getDealership();

        $this->assertInstanceOf(Dealership::class, $dealership);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::setDealership()
     */
    public function setDealershipMustBeReturnDealershipObject()
    {
        $dealership = $this->dealershipMock();
        $result = $this->detail->setDealership($dealership);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::getClient()
     */
    public function getClientMustBeReturnClientObject()
    {
        $client = $this->detail->getClient();

        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::setClient()
     */
    public function setClientMustBeReturnClientObject()
    {
        $client = $this->clientMock();
        $result = $this->detail->setClient($client);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::getSequence()
     */
    public function getSequenceMustBeReturnSequenceObject()
    {
        $sequence = $this->detail->getSequence();

        $this->assertInstanceOf(Sequence::class, $sequence);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::setSequence()
     */
    public function setSequenceMustBeReturnSequenceObject()
    {
        $sequence = $this->sequenceMock();
        $result = $this->detail->setSequence($sequence);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::getPurchaser()
     */
    public function getPurchaserMustBeReturnPurchaserObject()
    {
        $purchaser = $this->detail->getPurchaser();

        $this->assertInstanceOf(Purchaser::class, $purchaser);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Received\Partial\Detail::setPurchaser()
     */
    public function setPurchaserMustBeReturnPurchaserObject()
    {
        $purchaser = $this->purchaserMock();
        $result = $this->detail->setPurchaser($purchaser);

        $this->assertNull($result);
    }
}
