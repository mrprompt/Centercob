<?php
namespace MrPrompt\Centercob\Received\Partial;

use DateTime;
use MrPrompt\Centercob\Common\Base\Customer;
use MrPrompt\Centercob\Common\Base\Sequence;

/**
 * File header
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class Header
{
    /**
     * Line length
     *
     * @const int
     */
    const LENGTH = 1006;

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
    const SHIPPING = 1;

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
     * @var string
     */
    private $passed;

    /**
     * Constructor
     * @param string $row
     */
    public function __construct($row)
    {
        $customer = new Customer();
        $customer->setName(substr($row, 5, 20));

        $this->passed   = substr($row, 2, 3);
        $this->customer = $customer;
        $this->created  = DateTime::createFromFormat('dmY h:i:s', substr($row, 25, 8) . ' 00:00:00');
        $this->sequence = new Sequence(substr($row, 500, 6));
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
     * @return string
     */
    public function getPassed()
    {
        return $this->passed;
    }

    /**
     * @param string $passed
     */
    public function setPassed($passed)
    {
        $this->passed = $passed;
    }
}
