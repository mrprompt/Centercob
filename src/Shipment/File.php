<?php
namespace MrPrompt\Centercob\Shipment;

use DateTime;
use MrPrompt\Centercob\Common\Base\Address;
use MrPrompt\Centercob\Common\Base\Authorization;
use MrPrompt\Centercob\Common\Base\Bank;
use MrPrompt\Centercob\Common\Base\BankAccount;
use MrPrompt\Centercob\Common\Base\Cart;
use MrPrompt\Centercob\Common\Base\Charge;
use MrPrompt\Centercob\Common\Base\ConsumerUnity;
use MrPrompt\Centercob\Common\Base\CreditCard;
use MrPrompt\Centercob\Common\Base\Customer;
use MrPrompt\Centercob\Common\Base\Document;
use MrPrompt\Centercob\Common\Base\Email;
use MrPrompt\Centercob\Common\Base\Holder;
use MrPrompt\Centercob\Common\Base\Occurrence;
use MrPrompt\Centercob\Common\Base\Parcel;
use MrPrompt\Centercob\Common\Base\Parcels;
use MrPrompt\Centercob\Common\Base\Phone;
use MrPrompt\Centercob\Common\Base\Purchaser;
use MrPrompt\Centercob\Common\Base\Seller;
use MrPrompt\Centercob\Common\Base\Sequence;
use MrPrompt\Centercob\Common\Util\Number;
use MrPrompt\Centercob\Shipment\Partial\Detail;
use MrPrompt\Centercob\Shipment\Partial\Footer;
use MrPrompt\Centercob\Shipment\Partial\Header;

/**
 * Shipment file class
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
    const TEMPLATE_GENERATED = '{CLIENT}_{DDMMYYYY}_{SEQUENCE}.TXT';

    /**
     * File name template
     *
     * @var string
     */
    const TEMPLATE_PROCESSED = '{CLIENT}_{DDMMYYYY}_{SEQUENCE}.TXT.RET';

    /**
     * @var DateTime
     */
    private $now;

    /**
     * @var string
     */
    private $content;

    /**
     * @var Header
     */
    private $header;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Footer
     */
    private $footer;

    /**
     * @var Sequence
     */
    private $sequence;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var string
     */
    private $storage;

    /**
     * @var string
     */
    private $template;

    /**
     * @param Customer $customer
     * @param Sequence $sequence
     * @param DateTime $today
     * @param string   $storageDir
     */
    public function __construct(
        Customer $customer,
        Sequence $sequence,
        DateTime $today,
        $storageDir = null
    ) {
        $this->customer     = $customer;
        $this->now          = $today;
        $this->sequence     = $sequence;
        $this->storage      = $storageDir;
        $this->content      = null;
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param Cart $cart
     */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return Footer
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * @param Footer $footer
     */
    public function setFooter(Footer $footer)
    {
        $this->footer = $footer;
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param Header $header
     */
    public function setHeader(Header $header)
    {
        $this->header = $header;
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
            '{DDMMYYYY}',
            '{SEQUENCE}'
        ];

        $replace = [
            Number::zeroFill($this->customer->getCode(), 6, Number::FILL_LEFT),
            $this->now->format('dmY'),
            Number::zeroFill($this->sequence->getValue(), 5, Number::FILL_LEFT),
        ];

        return str_replace($search, $replace, $type);
    }

    /**
     * @param $parcels
     * @return int
     */
    private function getTotalPrice($parcels)
    {
        $price = 0;

        foreach ($parcels as $parcel) {
            $price += $parcel->getPrice();
        }

        return $price;
    }

    /**
     * @return string
     */
    private function generateContent()
    {
        $totalPrice     = 0;
        $counter        = 2;

        $this->header = new Header($this->customer, $this->sequence, $this->now);
        $this->content  = $this->header->render() . PHP_EOL;

        /* @var $detail \Centercob\Gateway\Shipment\Partial\Detail */
        foreach ($this->cart as $detail) {
            $detail->getSequence()->setValue($counter);

            $this->content .= $detail->render() . PHP_EOL;

            $totalPrice += $this->getTotalPrice( $detail->getParcels() );
            $counter++;
        }

        $sequence = clone $this->sequence;
        $sequence->setValue($counter);

        $this->footer = new Footer(($counter - 1), $totalPrice, $sequence);

        $this->content .= $this->footer->render();

        return $this->content;
    }

    /**
     * @return string
     */
    public function save()
    {
        if (null === $this->content) {
            $this->content = $this->generateContent();
        }

        $this->template = self::TEMPLATE_GENERATED;

        $this->header->setSequence($this->sequence);

        $filename   = $this->createFilename($this->template);
        $outputFile = $this->storage . DIRECTORY_SEPARATOR . $filename;

        file_put_contents($outputFile, $this->content);

        return $outputFile;
    }

    /**
     * @return string
     */
    public function read()
    {
        $this->template = self::TEMPLATE_GENERATED;

        $file = $this->storage . DIRECTORY_SEPARATOR . $this->createFilename($this->template);

        $this->content  = file_get_contents($file);

        $details        = explode(PHP_EOL, $this->content);
        $headerLine     = array_shift($details);
        $footerLine     = array_pop($details);

        if (null == $footerLine) {
            $footerLine = array_pop($details);
        }

        $this->header   = new Header(
            $this->customer,
            new Sequence(substr($headerLine, 1000, 6)),
            $this->now
        );

        $this->footer   = new Footer(
            substr($footerLine, 1, 6),
            substr($footerLine, 7, 10),
            (new Sequence(substr($footerLine, 1000, 6)))
        );

        $this->cart = new Cart();

        /* @var $detail \Centercob\Gateway\Received\Partial\Detail */
        foreach ($details as $row) {
            $charge         = new Charge();
            $card           = new CreditCard();
            $account        = new BankAccount(new Bank(), new Holder());
            $unity          = new ConsumerUnity();
            $seller         = new Seller();

            $parcels        = $this->createParcels($row);
            $authorization  = $this->createAuthorization($row);
            $sequence       = new Sequence(substr($row, 1000, 6));

            // extracting object from line
            $unity->setNumber(substr($row, 9, 25));
            $unity->setRead(DateTime::createFromFormat('dmY', substr($row, 141, 8)));
            $unity->setMaturity(DateTime::createFromFormat('dmY', substr($row, 149, 8)));

            $occurrence = new Occurrence();
            $occurrence->setType(substr($row, 44, 1));
            $occurrence->setReturn(substr($row, 783, 2));
            $occurrence->setDescription(substr($row, 785, 100));

            $charge->setCharging(substr($row, 8, 1));
            $charge->setOccurrence($occurrence);

            $address = new Address();
            $address->setCity(substr($row, 69, 50));
            $address->setState(substr($row, 119, 2));
            $address->setPostalCode(substr($row, 121, 8));
            $address->setAddress(substr($row, 461, 50));
            $address->setNumber(substr($row, 511, 6));
            $address->setDistrict(substr($row, 517, 30));
            $address->setComplement(substr($row, 547, 30));

            $seller->setCode(substr($row, 135, 6));

            $document = new Document();
            $document->setNumber(substr($row, 368, 15));

            $account->getHolder()->setName(substr($row, 158, 70));
            $account->getHolder()->setDocument($document);

            switch ($charge->getCharging()) {
                case Charge::CREDIT_CARD:
                    $card->setFlag(substr(substr($row, 129, 6), -2));
                    break;

                case Charge::DEBIT:
                    $account->getBank()->setCode(substr(substr($row, 129, 6), -2));
                    break;

                case Charge::ENERGY:
                    $unity->setCode(substr(substr($row, 129, 6), -2));
                    break;
            }

            $purchaser = $this->createPurchaser($row);
            $purchaser->setAddress($address);
            $purchaser->setDocument($document);

            $detail = new Detail(
                $this->customer,
                $charge,
                $seller,
                $purchaser,
                $parcels,
                $authorization,
                $card,
                $account,
                $unity,
                $sequence
            );

            $this->cart->append($detail);
        }

        return [
            $this->header,
            $this->cart,
            $this->footer
        ];
    }

    /**
     * @param string $row
     * @return Purchaser
     */
    private function createPurchaser($row)
    {
        $purchaser      = new Purchaser();
        $purchaser->setPerson(substr($row, 157, 1));
        $purchaser->setName(substr($row, 158, 70));
        $purchaser->setPurchaserFantasyName(substr($row, 228, 70));
        $purchaser->setPurchaserSocialReason(substr($row, 298, 70));
        $purchaser->setBirth(DateTime::createFromFormat('dmY', substr($row, 403, 8)));
        $purchaser->setEmail(new Email(substr($row, 411, 50)));
        $purchaser->setHomePhone(new Phone(substr($row, 577, 11), Phone::TELEPHONE));
        $purchaser->setCellPhone(new Phone(substr($row, 599, 11), Phone::CELLPHONE));
        $purchaser->setFatherName(substr($row, 617, 50));
        $purchaser->setMotherName(substr($row, 667, 50));

        return $purchaser;
    }

    /**
     * @param $row
     * @return Parcels
     */
    private function createParcels($row)
    {

        $parcelOne = new Parcel();
        $parcelOne->setMaturity(DateTime::createFromFormat('dmY', substr($row, 717, 8)));
        $parcelOne->setPrice(substr($row, 725, 10));
        $parcelOne->setQuantity(substr($row, 735, 2));
        $parcelOne->setKey(0);

        $parcelTwo = new Parcel();
        $parcelTwo->setPrice(substr($row, 737, 10));
        $parcelTwo->setQuantity(substr($row, 747, 2));
        $parcelTwo->setKey(1);

        $parcelThree = new Parcel();
        $parcelThree->setPrice(substr($row, 749, 10));
        $parcelThree->setQuantity(substr($row, 759, 2));
        $parcelThree->setKey(2);

        $parcelFour = new Parcel();
        $parcelFour->setPrice(substr($row, 761, 10));
        $parcelFour->setQuantity(substr($row, 771, 2));
        $parcelFour->setKey(3);

        $parcels = new Parcels(4);
        $parcels->addParcel($parcelOne);
        $parcels->addParcel($parcelTwo);
        $parcels->addParcel($parcelThree);
        $parcels->addParcel($parcelFour);

        return $parcels;
    }

    /**
     * @param $row
     * @return Authorization
     */
    private function createAuthorization($row)
    {
        $authorization  = new Authorization();
        $authorization->setNumber(substr($row, 773, 10));

        return $authorization;
    }
}
