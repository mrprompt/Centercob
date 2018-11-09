<?php
namespace MrPrompt\Centercob\Received;

use DateTime;
use MrPrompt\Centercob\Common\Base\Cart;
use MrPrompt\Centercob\Common\Base\Customer;
use MrPrompt\Centercob\Common\Util\Number;
use MrPrompt\Centercob\Received\Partial\Detail;
use MrPrompt\Centercob\Received\Partial\Footer;
use MrPrompt\Centercob\Received\Partial\Header;

/**
 * Received file class
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class File
{
    /**
     * File name template
     *
     * @var string
     */
    const TEMPLATE_GENERATED = 'RET{CLIENT}-{DD.MM.YYYY-HH.MM.SS}.TXT';

    /**
     * File name template
     *
     * @var string
     */
    const TEMPLATE_PROCESSED = 'RET{CLIENT}-{DD.MM.YYYY-HH.MM.SS}.TXT';

    /**
     * @var Header
     */
    private $header;

    /**
     * @var ArrayObject
     */
    private $cart;

    /**
     * @var Footer
     */
    private $footer;

    /**
     * @var array
     */
    private $rows = [];

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var DateTime
     */
    private $now;

    /**
     * @param Customer $customer
     * @param DateTime $date
     * @param string $storageDir
     */
    public function __construct(Customer $customer, DateTime $date, $storageDir = null)
    {
        $this->customer = $customer;
        $this->now      = $date;

        $file           = $storageDir . DIRECTORY_SEPARATOR . $this->createFilename();
        $content        =  file_get_contents($file);

        $this->rows     = explode(PHP_EOL, $content);

        $this->getHeader();
        $this->getFooter();
        $this->getCart();
    }

    /**
     * Create the file name
     *
     * @return string
     */
    private function createFilename($type = self::TEMPLATE_GENERATED)
    {
        $search = [
            '{CLIENT}',
            '{DD.MM.YYYY-HH.MM.SS}',
        ];

        $replace = [
            Number::zeroFill($this->customer->getCode(), 7, Number::FILL_LEFT),
            $this->now->format('d.m.Y-H.i.s'),
        ];

        return str_replace($search, $replace, $type);
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        $headerLine     = array_shift($this->rows);
        $this->header   = new Header($headerLine);

        return $this->header;
    }

    /**
     * @return Footer
     */
    public function getFooter()
    {
        $footerLine     = array_pop($this->rows);

        if (null === $footerLine || "" === $footerLine) {
            $footerLine = array_pop($this->rows);
        }

        $this->footer   = new Footer($footerLine);

        return $this->footer;
    }

    /**
     * @return \ArrayObject
     */
    public function getCart()
    {
        $this->cart     = new Cart();

        /* @var $detail \Centercob\Gateway\Received\Partial\Detail */
        foreach ($this->rows as $row) {
            $detail = new Detail($row);

            $this->cart->addItem($detail);
        }

        return $this->cart;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return [
            $this->header,
            $this->cart,
            $this->footer
        ];
    }
}
