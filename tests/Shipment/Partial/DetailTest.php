<?php
namespace MrPrompt\Centercob\Tests\Shipment\Partial;

use PHPUnit\Framework\TestCase;
use MrPrompt\ShipmentCommon\Base\Bank;
use MrPrompt\ShipmentCommon\Base\Charge;
use MrPrompt\ShipmentCommon\Base\Holder;
use MrPrompt\ShipmentCommon\Base\Seller;
use MrPrompt\ShipmentCommon\Base\Parcels;
use MrPrompt\ShipmentCommon\Base\Customer;
use MrPrompt\ShipmentCommon\Base\Sequence;
use MrPrompt\ShipmentCommon\Base\Purchaser;
use MrPrompt\ShipmentCommon\Base\CreditCard;
use MrPrompt\ShipmentCommon\Base\BankAccount;
use MrPrompt\Centercob\Shipment\Partial\Detail;
use MrPrompt\ShipmentCommon\Base\Authorization;
use MrPrompt\ShipmentCommon\Base\ConsumerUnity;
use MrPrompt\Centercob\Tests\Mock as CentercobMock;
use MrPrompt\Centercob\Tests\ChangeProtectedAttribute;

/**
 * Detail test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class DetailTest extends TestCase
{
    use ChangeProtectedAttribute;
    use CentercobMock;

    /**
     * Detail
     * @var Detail
     */
    private $detail;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->detail = new Detail(
            $this->customerMock(),
            $this->chargeMock(),
            $this->sellerMock(),
            $this->purchaserMock(),
            $this->parcelsMock(),
            $this->authorizationMock(),
            $this->creditCardMock(),
            $this->bankAccountMock(),
            $this->unityMock(),
            $this->sequenceMock()
        );
    }

    /**
     * Cleanup
     */
    public function tearDown()
    {
        $this->detail = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getCustomer()
     */
    public function getCustomerMustBeReturnCustomerAttribute()
    {
        $customer = Customer::class;

        $this->assertInstanceOf($customer, $this->detail->getCustomer());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setCustomer()
     */
    public function setCustomerMustBeReturnNull()
    {
        $customer = new Customer();
        $result   = $this->detail->setCustomer($customer);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getCharge()
     */
    public function getChargeMustBeReturnChargeAttribute()
    {
        $charge = Charge::class;

        $this->assertInstanceOf($charge, $this->detail->getCharge());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setCharge()
     */
    public function setChargeMustBeReturnNull()
    {
        $charge = new Charge();
        $result   = $this->detail->setCharge($charge);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getConsumerUnity()
     */
    public function getConsumerunityMustBeReturnConsumerunityAttribute()
    {
        $consumerunity = ConsumerUnity::class;

        $this->assertInstanceOf($consumerunity, $this->detail->getConsumerUnity());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setConsumerunity()
     */
    public function setConsumerunityMustBeReturnNull()
    {
        $consumerunity = new ConsumerUnity();
        $result   = $this->detail->setConsumerunity($consumerunity);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getSeller()
     */
    public function getSellerMustBeReturnSellerAttribute()
    {
        $seller = Seller::class;

        $this->assertInstanceOf($seller, $this->detail->getSeller());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setSeller()
     */
    public function setSellerMustBeReturnNull()
    {
        $seller   = new Seller();
        $result   = $this->detail->setSeller($seller);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getPurchaser()
     */
    public function getPurchaserMustBeReturnPurchaserAttribute()
    {
        $purchaser = Purchaser::class;

        $this->assertInstanceOf($purchaser, $this->detail->getPurchaser());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setPurchaser()
     */
    public function setPurchaserMustBeReturnNull()
    {
        $purchaser = new Purchaser();
        $result   = $this->detail->setPurchaser($purchaser);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getBankAccount()
     */
    public function getBankAccountMustBeReturnBankAccountAttribute()
    {
        $bankAccount = BankAccount::class;

        $this->assertInstanceOf($bankAccount, $this->detail->getBankAccount());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setBankAccount()
     */
    public function setBankAccountMustBeReturnNull()
    {
        $bank        = new Bank();
        $holder      = new Holder();
        $bankAccount = new BankAccount($bank, $holder);

        $result      = $this->detail->setBankAccount($bankAccount);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getParcels()
     */
    public function getParcelsMustBeReturnParcelsAttribute()
    {
        $parcels = Parcels::class;

        $this->assertInstanceOf($parcels, $this->detail->getParcels());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setParcels()
     */
    public function setParcelsMustBeReturnNull()
    {
        $parcels = new Parcels();
        $result  = $this->detail->setParcels($parcels);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getAuthorization()
     */
    public function getAuthorizationMustBeReturnAuthorizationAttribute()
    {
        $authorization = Authorization::class;

        $this->assertInstanceOf($authorization, $this->detail->getAuthorization());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setAuthorization()
     */
    public function setAuthorizationMustBeReturnNull()
    {
        $authorization  = new Authorization();
        $result         = $this->detail->setAuthorization($authorization);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getCreditCard()
     */
    public function getCreditCardMustBeReturnCreditCardAttribute()
    {
        $creditCard = CreditCard::class;

        $this->assertInstanceOf($creditCard, $this->detail->getCreditCard());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setCreditCard()
     */
    public function setCreditCardMustBeReturnNull()
    {
        $creditCard = new CreditCard();
        $result     = $this->detail->setCreditCard($creditCard);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::getSequence()
     */
    public function getSequenceMustBeReturnSequenceAttribute()
    {
        $sequence = Sequence::class;

        $this->assertInstanceOf($sequence, $this->detail->getSequence());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::setSequence()
     */
    public function setSequenceMustBeReturnNull()
    {
        $sequence = new Sequence();
        $result   = $this->detail->setSequence($sequence);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Shipment\Partial\Detail::render()
     */
    public function renderReturnExactSize()
    {
        $this->assertEquals(1006, strlen($this->detail->render()));
    }
}
