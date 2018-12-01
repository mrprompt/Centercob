<?php
namespace MrPrompt\Centercob\Shipment\Partial;

use DateTime;
use MrPrompt\ShipmentCommon\Type\Numeric;
use MrPrompt\ShipmentCommon\Base\Customer;
use MrPrompt\ShipmentCommon\Base\Sequence;
use MrPrompt\ShipmentCommon\Type\Alphanumeric;

/**
 * File header
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class Header
{
    /**
     * Type of register
     *
     * @const string
     */
    const TYPE = 'A';

    /**
     * Shippment code
     *
     * @const int
     */
    const SHIPPING = 2;

    /**
     * Layout version
     *
     * @const int
     */
    const VERSION = '00000013';

    /**
     * Sequencial line
     *
     * @const int
     */
    const LINE = 1;

    /**
     * Customer Code
     *
     * @var Customer
     */
    private $customer;

    /**
     * File date creation
     *
     * @var DateTime
     */
    private $created;

    /**
     * Sequencial number of file
     *
     * @var Sequence
     */
    private $sequence;

    /**
     * Constructor
     *
     * @param Customer $customer
     * @param Sequence $sequence
     * @param DateTime $created
     */
    public function __construct(Customer $customer, Sequence $sequence, DateTime $created)
    {
        $this->customer = $customer;
        $this->sequence = $sequence;
        $this->created  = $created;
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
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;
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
     * Render header file
     *
     * @return string
     */
    public function render()
    {
        // register type
        $line  = self::TYPE;

        // shipping code
        $line .= self::SHIPPING;

        // customer code
        $line .= str_pad($this->customer->getCode(), 6, Numeric::FILL, Numeric::ALIGN);

        // date from file
        $line .= $this->created->format('dmY');

        // whitespace
        $line .= str_pad('', 970, Alphanumeric::FILL, Alphanumeric::ALIGN);

        // layout version
        $line .= str_pad(self::VERSION, 8, Alphanumeric::FILL, Alphanumeric::ALIGN);

        // sequence file
        $line .= str_pad($this->sequence->getValue(), 6, Numeric::FILL, Numeric::ALIGN);

        // sequence line
        $line .= str_pad(self::LINE, 6, Numeric::FILL, Numeric::ALIGN);

        // resulting...
        return $line;
    }
}
