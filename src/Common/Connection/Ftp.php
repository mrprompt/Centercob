<?php
namespace MrPrompt\Centercob\Util\Connection;

use Ftp as Connector;

/**
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class Ftp
{
    const ADDRESS               = 'ftp2.centercob.com.br';
    const SHIPMENT              = '/Enviados';
    const SHIPMENT_PROCESSED    = '/Enviados/Processados';
    const RECEIVED              = '/Recebidos';
    const RECEIVED_PROCESSED    = '/Recebidos/Processados';

    /**
     * @var Ftp
     */
    private $connection;

    /**
     * @param $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        $this->connection = new Connector();
        $this->connection->connect(self::ADDRESS);
        $this->connection->login($user, $password);
    }

    /**
     * @return Ftp
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param Ftp $connection
     */
    public function setConnection(Ftp $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Disconnect
     */
    public function __destruct()
    {
        if ($this->connection instanceof Ftp) {
            $this->connection->close();
        }
    }
}
