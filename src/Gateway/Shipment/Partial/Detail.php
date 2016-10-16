<?php
namespace MrPrompt\Centercob\Gateway\Shipment\Partial;

use MrPrompt\Centercob\Common\Base\Authorization;
use MrPrompt\Centercob\Common\Base\BankAccount;
use MrPrompt\Centercob\Common\Base\Charge;
use MrPrompt\Centercob\Common\Base\ConsumerUnity;
use MrPrompt\Centercob\Common\Base\CreditCard;
use MrPrompt\Centercob\Common\Base\Customer;
use MrPrompt\Centercob\Common\Base\Dealership;
use MrPrompt\Centercob\Common\Base\Parcels;
use MrPrompt\Centercob\Common\Base\Purchaser;
use MrPrompt\Centercob\Common\Base\Seller;
use MrPrompt\Centercob\Common\Base\Sequence;
use MrPrompt\Centercob\Common\Base\Holder;
use MrPrompt\Centercob\Common\Type\Alphanumeric;
use MrPrompt\Centercob\Common\Type\Numeric;

/**
 * File detail
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class Detail
{
    /**
     * Type of register
     *
     * @var string
     */
    const TYPE = 'D';

    /**
     * Shipment code
     *
     * @var int
     */
    const SHIPPING = 2;

    /**
     * Date Format
     *
     * @var string
     */
    const DATE_FORMAT = 'dmY';

    /**
     * Customer
     *
     * @var Customer
     */
    private $customer;

    /**
     * Charge
     *
     * @var charge
     */
    private $charge;

    /**
     * Consumer Unity
     *
     * @var ConsumerUnity
     */
    private $consumerUnity;

    /**
     * Dealership
     *
     * @var Dealership
     */
    private $dealership;

    /**
     * Seller
     *
     * @var Seller
     */
    private $seller;

    /**
     * Purchaser
     *
     * @var Purchaser
     */
    private $purchaser;

    /**
     * Bank account
     *
     * @var BankAccount
     */
    private $bankAccount;

    /**
     * Parcels
     *
     * @var Parcels
     */
    private $parcels;

    /**
     * Authorization
     *
     * @var Authorization
     */
    private $authorization;

    /**
     * Credit Card
     *
     * @var CreditCard
     */
    private $creditCard;

    /**
     * Sequence
     *
     * @var Sequence
     */
    private $sequence;

    /**
     * Holder
     *
     * @var Holder
     */
    private $holder;

    /**
     * Constructor
     *
     * @param Customer $customer
     * @param Charge $charge
     * @param Seller $seller
     * @param Purchaser $purchaser
     * @param Parcels $parcels
     * @param Authorization $authorization
     * @param CreditCard $creditCard
     * @param BankAccount $bankAccount
     * @param ConsumerUnity $consumerUnity
     * @param Sequence $sequence
     */
    public function __construct(
        Customer $customer,
        Charge $charge,
        Seller $seller,
        Purchaser $purchaser,
        Parcels $parcels,
        Authorization $authorization,
        CreditCard $creditCard,
        BankAccount $bankAccount,
        ConsumerUnity $consumerUnity,
        Sequence $sequence
    ) {
        $this->customer         = $customer;
        $this->charge           = $charge;
        $this->consumerUnity    = $consumerUnity;
        $this->seller           = $seller;
        $this->purchaser        = $purchaser;
        $this->bankAccount      = $bankAccount;
        $this->parcels          = $parcels;
        $this->authorization    = $authorization;
        $this->creditCard       = $creditCard;
        $this->sequence         = $sequence;
        $this->dealership       = new Dealership();
        $this->holder           = new Holder();

        switch ($this->charge->getCharging()) {
            case Charge::CREDIT_CARD:
                $this->dealership->setCode($this->creditCard->getFlag());
                break;

            case Charge::DEBIT:
                $this->dealership->setCode($this->bankAccount->getBank()->getCode());
                break;

            case Charge::ENERGY:
                $this->dealership->setCode($this->consumerUnity->getCode());
                break;

            case Charge::BILLET:
                $this->dealership->setCode($this->bankAccount->getBank()->getCode());
                break;
        }
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return Charge
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @param Charge $charge
     */
    public function setCharge(Charge $charge)
    {
        $this->charge = $charge;
    }

    /**
     * @return ConsumerUnity
     */
    public function getConsumerUnity()
    {
        return $this->consumerUnity;
    }

    /**
     * @param ConsumerUnity $consumerUnity
     */
    public function setConsumerUnity(ConsumerUnity $consumerUnity)
    {
        $this->consumerUnity = $consumerUnity;
    }

    /**
     * @return Seller
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param Seller $seller
     */
    public function setSeller(Seller $seller)
    {
        $this->seller = $seller;
    }

    /**
     * @return Purchaser
     */
    public function getPurchaser()
    {
        return $this->purchaser;
    }

    /**
     * @param Purchaser $purchaser
     */
    public function setPurchaser(Purchaser $purchaser)
    {
        $this->purchaser = $purchaser;
    }

    /**
     * @return BankAccount
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }

    /**
     * @param BankAccount $bankAccount
     */
    public function setBankAccount(BankAccount $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    /**
     * @return Parcels
     */
    public function getParcels()
    {
        return $this->parcels;
    }

    /**
     * @param Parcels $parcels
     */
    public function setParcels(Parcels $parcels)
    {
        $this->parcels = $parcels;
    }

    /**
     * @return Authorization
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * @param Authorization $authorization
     */
    public function setAuthorization(Authorization $authorization)
    {
        $this->authorization = $authorization;
    }

    /**
     * @return CreditCard
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCard $creditCard
     */
    public function setCreditCard(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;
    }

    /**
     * @return Sequence
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param Sequence $sequence
     */
    public function setSequence(Sequence $sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * Render detail registry line
     *
     * @return string
     */
    public function render()
    {
        // Register code
        $result  = str_pad(self::TYPE, 1, Alphanumeric::FILL, Alphanumeric::ALIGN);

        // Shipping code
        $result .= str_pad(self::SHIPPING, 1, Numeric::FILL, Numeric::ALIGN);

        // Customer code
        $result .= substr(str_pad($this->customer->getCode(), 6, Numeric::FILL, Numeric::ALIGN), 0, 6);

        // Charging type
        $result .= substr(str_pad($this->charge->getCharging(), 1, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 1);

        // Consumer Unity from client
        $result .= substr(str_pad($this->consumerUnity->getNumber(), 25, Numeric::FILL, Numeric::ALIGN), 0, 25);

        // white space
        $result .= str_pad('', 10, Numeric::FILL, Numeric::ALIGN);

        // Occurrence type
        $result .= substr(str_pad($this->charge->getOccurrence()->getType(), 1, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 1);

        // white space
        $result .= str_pad('', 24, Alphanumeric::FILL, Alphanumeric::ALIGN);

        // City, state and Postal Code
        $result .= substr(str_pad($this->purchaser->getAddress()->getCity(), 50, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 50);
        $result .= substr(str_pad($this->purchaser->getAddress()->getState(), 2, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 2);
        $result .= substr(str_pad($this->purchaser->getAddress()->getPostalCode(), 8, Numeric::FILL, Numeric::ALIGN), 0, 8);

        // Dealership code
        $result .= substr(str_pad($this->dealership->getCode(), 6, Numeric::FILL, Numeric::ALIGN), 0, 6);

        // Seller code
        $result .= substr(str_pad($this->seller->getCode(), 6, Numeric::FILL, Numeric::ALIGN), 0, 6);

        // energy charge type
        $result .= substr($this->consumerUnity->getRead()->format(self::DATE_FORMAT), 0, 8);
        $result .= substr($this->consumerUnity->getMaturity()->format(self::DATE_FORMAT), 0, 8);

        // type person
        $result .= substr(str_pad($this->seller->getPerson(), 1, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 1);

        // person name
        $result .= substr(str_pad($this->purchaser->getName(), 70, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 70);

        // fantasy name
        $result .= substr(str_pad($this->purchaser->getPurchaserFantasyName(), 70, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 70);

        // social reason
        $result .= substr(str_pad($this->purchaser->getPurchaserSocialReason(), 70, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 70);

        // document number
        $result .= substr(str_pad($this->purchaser->getDocument()->getNumber(), 15, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 15);
        $result .= substr(str_pad($this->purchaser->getPurchaserStateRegistration(), 20, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 20);

        // purchaser birth day
        $result .= $this->purchaser->getBirth()->format(self::DATE_FORMAT);

        $result .= substr(str_pad($this->purchaser->getEmail()->getAddress(), 50, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 50);
        $result .= substr(str_pad($this->purchaser->getAddress()->getAddress(), 50, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 50);
        $result .= substr(str_pad($this->purchaser->getAddress()->getNumber(), 6, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 6);
        $result .= substr(str_pad($this->purchaser->getAddress()->getDistrict(), 30, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 30);
        $result .= substr(str_pad($this->purchaser->getAddress()->getComplement(), 30, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 30);
        $result .= substr(str_pad($this->purchaser->getHomePhone()->getNumber(), 11, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 11);
        $result .= substr(str_pad($this->purchaser->getHomePhoneSecondary()->getNumber(), 11, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 11);
        $result .= substr(str_pad($this->purchaser->getCellPhone()->getNumber(), 11, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 11);

        // whitespace
        $result .= str_pad('', 7, Alphanumeric::FILL, Alphanumeric::ALIGN);

        // fathers
        $result .= substr(str_pad($this->purchaser->getFatherName(), 50, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 50);
        $result .= substr(str_pad($this->purchaser->getMotherName(), 50, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 50);

        // maturity date from first parcel
        $result .= substr($this->parcels->offsetGet(0)->getMaturity()->format(self::DATE_FORMAT), 0, 8);

        // first parcel
        $result .= substr(str_pad($this->parcels->offsetGet(0)->getPrice(), 10, Numeric::FILL, Numeric::ALIGN), 0, 10);
        $result .= substr(str_pad($this->parcels->offsetGet(0)->getQuantity(), 2, Numeric::FILL, Numeric::ALIGN), 0, 2);

        // second parcel
        if ($this->parcels->offsetExists(1)) {
            $result .= substr(str_pad($this->parcels->offsetGet(1)->getPrice(), 10, Numeric::FILL, Numeric::ALIGN), 0, 10);
            $result .= substr(str_pad($this->parcels->offsetGet(1)->getQuantity(), 2, Numeric::FILL, Numeric::ALIGN), 0, 2);
        } else {
            $result .= substr(str_pad(0, 10, Numeric::FILL, Numeric::ALIGN), 0, 10);
            $result .= substr(str_pad(0, 2, Numeric::FILL, Numeric::ALIGN), 0, 2);
        }

        // third parcel
        if ($this->parcels->offsetExists(2)) {
            $result .= substr(str_pad($this->parcels->offsetGet(2)->getPrice(), 10, Numeric::FILL, Numeric::ALIGN), 0, 10);
            $result .= substr(str_pad($this->parcels->offsetGet(2)->getQuantity(), 2, Numeric::FILL, Numeric::ALIGN), 0, 2);
        } else {
            $result .= substr(str_pad(0, 10, Numeric::FILL, Numeric::ALIGN), 0, 10);
            $result .= substr(str_pad(0, 2, Numeric::FILL, Numeric::ALIGN), 0, 2);
        }

        // fourth parcel
        if ($this->parcels->offsetExists(3)) {
            $result .= substr(str_pad($this->parcels->offsetGet(3)->getPrice(), 10, Numeric::FILL, Numeric::ALIGN), 0, 10);
            $result .= substr(str_pad($this->parcels->offsetGet(3)->getQuantity(), 2, Numeric::FILL, Numeric::ALIGN), 0, 2);
        } else {
            $result .= substr(str_pad(0, 10, Numeric::FILL, Numeric::ALIGN), 0, 10);
            $result .= substr(str_pad(0, 2, Numeric::FILL, Numeric::ALIGN), 0, 2);
        }

        // authorization number
        $result .= substr(str_pad($this->authorization->getNumber(), 10, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 10);

        // occurrence code return
        $result .= substr(str_pad($this->charge->getOccurrence()->getReturn(), 2, Numeric::FILL, Numeric::ALIGN), 0, 2);

        // occurrence description
        $result .= substr(str_pad($this->charge->getOccurrence()->getDescription(), 100, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 100);

        // customer identity number
        $result .= substr(str_pad($this->customer->getIdentityNumber(), 25, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 25);

        // agency (only to automatic debit)
        $result .= substr(str_pad($this->bankAccount->getBank()->getAgency(), 8, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 8);
        $result .= substr(str_pad($this->bankAccount->getBank()->getDigit(), 3, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 3);

        // account (only to automatic debit)
        $result .= substr(str_pad($this->bankAccount->getNumber(), 12, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 12);
        $result .= substr(str_pad($this->bankAccount->getDigit(), 3, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 3);
        $result .= substr(str_pad($this->bankAccount->getOperation(), 4, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 4);
        $result .= substr(str_pad(($this->bankAccount->getSecurity() ? 'S' : 'N'), 1, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 1);

        // credit card (only for credit card payments, of course)
        $result .= substr(str_pad($this->creditCard->getNumber(), 16, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 16);
        $result .= str_pad('', 3, Alphanumeric::FILL, Alphanumeric::ALIGN);
        $result .= substr($this->creditCard->getValidate()->format('mY'), 0, 6);
        $result .= substr(str_pad($this->creditCard->getSecurityNumber(), 5, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 5);

        // Helpful maturity
        $result .= substr(str_pad(($this->customer->getHelpfulMaturity() ? 'S' : 'N'), 1, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 1);

        // Working days
        $result .= substr(str_pad($this->customer->getWorkingDays(), 2, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 2);

        // type person of purchaser
        $result .= substr(str_pad($this->purchaser->getPerson(), 1, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 1);

        // document from purchaser
        $result .= substr(str_pad($this->purchaser->getDocument()->getNumber(), 20, Alphanumeric::FILL, Alphanumeric::ALIGN), 0, 20);

        // white spaces
        $result .= str_pad('', 5, Alphanumeric::FILL, Alphanumeric::ALIGN);

        // sequence number from line
        $result .= substr(str_pad($this->sequence->getValue(), 6, Numeric::FILL, Numeric::ALIGN), 0, 6);

        // resulting....
        return $result;
    }
}
