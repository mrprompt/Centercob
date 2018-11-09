<?php
namespace MrPrompt\Centercob\Received\Partial;

use MrPrompt\Centercob\Common\Base\Authorization;
use MrPrompt\Centercob\Common\Base\Client;
use MrPrompt\Centercob\Common\Base\ConsumerUnity;
use MrPrompt\Centercob\Common\Base\Dealership;
use MrPrompt\Centercob\Common\Base\Document;
use MrPrompt\Centercob\Common\Base\Occurrence;
use MrPrompt\Centercob\Common\Base\Parcel;
use MrPrompt\Centercob\Common\Base\Purchaser;
use MrPrompt\Centercob\Common\Base\Sequence;

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
     * @var ConsumerUnity
     */
    private $consumerUnity;

    /**
     * @var Occurrence
     */
    private $occurrence;

    /**
     * @var Parcel
     */
    private $parcel;

    /**
     * @var Authorization
     */
    private $authorization;

    /**
     * @var Dealership
     */
    private $dealership;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Sequence
     */
    private $sequence;

    /**
     * @var Purchaser
     */
    private $purchaser;

    /**
     * Constructor
     * @param string $row
     */
    public function __construct($row)
    {
        $consumerUnity = new ConsumerUnity();
        $consumerUnity->setNumber(substr($row, 1, 25));

        $date       = substr($row, 28, 8);
        $occurrence = new Occurrence();
        $occurrence->setReturn(substr($row, 26, 2));
        $occurrence->setDate(\DateTime::createFromFormat('dmY', $date));
        $occurrence->setDescription(substr($row, 200, 50));

        $date   = substr($row, 126, 8);
        $parcel = new Parcel();
        $parcel->setPrice(substr($row, 54, 10));
        $parcel->setKey((int) substr($row, 257, 2));
        $parcel->setMaturity(\DateTime::createFromFormat('dmY', $date));

        $document = new Document();
        $document->setNumber(preg_replace('/[^[:digit:]]/', '', substr($row, 134, 20)));

        $authorization = new Authorization();
        $authorization->setNumber(substr($row, 154, 10));

        $dealership = new Dealership();
        $dealership->setCode(substr($row, 164, 6));
        $dealership->setName(substr($row, 170, 30));

        $client = new Client();
        $client->setCode((int) substr($row, 369, 25));

        $purchaser = new Purchaser();
        $purchaser->setName(substr($row, 76, 50));
        $purchaser->setDocument($document);
        $purchaser->setSalaried(substr($row, 404, 1));

        $sequence = new Sequence(substr($row, 500, 6));

        $this->consumerUnity    = $consumerUnity;
        $this->occurrence       = $occurrence;
        $this->parcel           = $parcel;
        $this->authorization    = $authorization;
        $this->dealership       = $dealership;
        $this->client           = $client;
        $this->sequence         = $sequence;
        $this->purchaser        = $purchaser;
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
     * @return Occurrence
     */
    public function getOccurrence()
    {
        return $this->occurrence;
    }

    /**
     * @param Occurrence $occurrence
     */
    public function setOccurrence(Occurrence $occurrence)
    {
        $this->occurrence = $occurrence;
    }

    /**
     * @return Parcel
     */
    public function getParcel()
    {
        return $this->parcel;
    }

    /**
     * @param Parcel $parcel
     */
    public function setParcel(Parcel $parcel)
    {
        $this->parcel = $parcel;
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
     * @return Dealership
     */
    public function getDealership()
    {
        return $this->dealership;
    }

    /**
     * @param Dealership $dealership
     */
    public function setDealership(Dealership $dealership)
    {
        $this->dealership = $dealership;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
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
}
