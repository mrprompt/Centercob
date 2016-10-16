<?php
namespace MrPrompt\Centercob\Tests\Gateway\Shipment\Partial;

use MrPrompt\Centercob\Common\Base\Bank;
use MrPrompt\Centercob\Common\Base\Holder;
use PHPUnit_Framework_TestCase;
use MrPrompt\Centercob\Gateway\Shipment\Partial\Detail;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use MrPrompt\Centercob\Tests\Gateway\Mock as CentercobMock;
use MrPrompt\Centercob\Common\Base\Customer;
use MrPrompt\Centercob\Common\Base\Charge;
use MrPrompt\Centercob\Common\Base\Seller;
use MrPrompt\Centercob\Common\Base\Purchaser;
use MrPrompt\Centercob\Common\Base\Parcels;
use MrPrompt\Centercob\Common\Base\Authorization;
use MrPrompt\Centercob\Common\Base\CreditCard;
use MrPrompt\Centercob\Common\Base\BankAccount;
use MrPrompt\Centercob\Common\Base\ConsumerUnity;
use MrPrompt\Centercob\Common\Base\Sequence;

/**
 * Detail test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class DetailTest extends PHPUnit_Framework_TestCase
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
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getCustomer()
     */
    public function getCustomerMustBeReturnCustomerAttribute()
    {
        $customer = Customer::class;

        $this->assertInstanceOf($customer, $this->detail->getCustomer());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setCustomer()
     */
    public function setCustomerMustBeReturnNull()
    {
        $customer = new Customer();
        $result   = $this->detail->setCustomer($customer);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getCharge()
     */
    public function getChargeMustBeReturnChargeAttribute()
    {
        $charge = Charge::class;

        $this->assertInstanceOf($charge, $this->detail->getCharge());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setCharge()
     */
    public function setChargeMustBeReturnNull()
    {
        $charge = new Charge();
        $result   = $this->detail->setCharge($charge);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getConsumerUnity()
     */
    public function getConsumerunityMustBeReturnConsumerunityAttribute()
    {
        $consumerunity = ConsumerUnity::class;

        $this->assertInstanceOf($consumerunity, $this->detail->getConsumerUnity());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setConsumerunity()
     */
    public function setConsumerunityMustBeReturnNull()
    {
        $consumerunity = new ConsumerUnity();
        $result   = $this->detail->setConsumerunity($consumerunity);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getSeller()
     */
    public function getSellerMustBeReturnSellerAttribute()
    {
        $seller = Seller::class;

        $this->assertInstanceOf($seller, $this->detail->getSeller());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setSeller()
     */
    public function setSellerMustBeReturnNull()
    {
        $seller   = new Seller();
        $result   = $this->detail->setSeller($seller);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getPurchaser()
     */
    public function getPurchaserMustBeReturnPurchaserAttribute()
    {
        $purchaser = Purchaser::class;

        $this->assertInstanceOf($purchaser, $this->detail->getPurchaser());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setPurchaser()
     */
    public function setPurchaserMustBeReturnNull()
    {
        $purchaser = new Purchaser();
        $result   = $this->detail->setPurchaser($purchaser);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getBankAccount()
     */
    public function getBankAccountMustBeReturnBankAccountAttribute()
    {
        $bankAccount = BankAccount::class;

        $this->assertInstanceOf($bankAccount, $this->detail->getBankAccount());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setBankAccount()
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
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getParcels()
     */
    public function getParcelsMustBeReturnParcelsAttribute()
    {
        $parcels = Parcels::class;

        $this->assertInstanceOf($parcels, $this->detail->getParcels());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setParcels()
     */
    public function setParcelsMustBeReturnNull()
    {
        $parcels = new Parcels();
        $result  = $this->detail->setParcels($parcels);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getAuthorization()
     */
    public function getAuthorizationMustBeReturnAuthorizationAttribute()
    {
        $authorization = Authorization::class;

        $this->assertInstanceOf($authorization, $this->detail->getAuthorization());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setAuthorization()
     */
    public function setAuthorizationMustBeReturnNull()
    {
        $authorization  = new Authorization();
        $result         = $this->detail->setAuthorization($authorization);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getCreditCard()
     */
    public function getCreditCardMustBeReturnCreditCardAttribute()
    {
        $creditCard = CreditCard::class;

        $this->assertInstanceOf($creditCard, $this->detail->getCreditCard());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setCreditCard()
     */
    public function setCreditCardMustBeReturnNull()
    {
        $creditCard = new CreditCard();
        $result     = $this->detail->setCreditCard($creditCard);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::getSequence()
     */
    public function getSequenceMustBeReturnSequenceAttribute()
    {
        $sequence = Sequence::class;

        $this->assertInstanceOf($sequence, $this->detail->getSequence());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::setSequence()
     */
    public function setSequenceMustBeReturnNull()
    {
        $sequence = new Sequence();
        $result   = $this->detail->setSequence($sequence);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::__construct()
     * @covers \MrPrompt\Centercob\Gateway\Shipment\Partial\Detail::render()
     */
    public function renderReturnExactSize()
    {
        $this->assertEquals(1006, strlen($this->detail->render()));
    }
}
