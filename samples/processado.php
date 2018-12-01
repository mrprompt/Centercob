<?php
/**
 * Exemplo de uso
 *
 * Leitura do arquivo de lote
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
use MrPrompt\ShipmentCommon\Base\Sequence;
use MrPrompt\Centercob\Shipment\File;
use MrPrompt\Centercob\Factory;

require __DIR__ . '/../bootstrap.php';

/* @var $lista array */
$lista      = require __DIR__ . '/cart.php';

try {
    /* @var $date \DateTime */
    $date       = new DateTime('2015-05-27');

    /* @var $sequence \MrPrompt\ShipmentCommon\Base\Sequence */
    $sequence   = new Sequence(6);

    /* @var $customer \MrPrompt\ShipmentCommon\Base\Customer */
    $customer   = Factory::createCustomerFromArray(array_shift($lista));

    /* @var $importer \MrPrompt\Centercob\Shipment\File */
    $importer   = new File($customer, $sequence, $date, __DIR__ . '/enviados', File::TEMPLATE_PROCESSED);

    // importing file data
    $result     = $importer->read();

    /* @var \MrPrompt\ShipmentCommon\Base\Cart */
    $cart = $importer->getCart();

    /* @var $lista array */
    $lista = [];

    /* @var $item \MrPrompt\Centercob\Shipment\Partial\Detail */
    foreach ($cart as $item) {
        /* @var $detail array */
        $detail  = Factory::createArrayFromDetail($item);;

        $lista[] = $detail;

        echo 'Tipo: ', $detail['cobranca'], PHP_EOL;
        echo 'Comprador: ', $detail['comprador']['nome'], PHP_EOL;
        echo 'Parcelas: ', PHP_EOL;

        foreach ($detail['parcelas'] as $parcel) {
            echo '      # ', key($detail['parcelas']), PHP_EOL;
            echo '     R$ ', number_format($parcel[ 'valor'], 2, ',', '.'), PHP_EOL;
            echo '    Qtd ', (int) $parcel['quantidade'], PHP_EOL;
        }

        echo 'Status: ', $detail['descricao'], PHP_EOL;
        echo PHP_EOL, PHP_EOL;
    }
} catch (\InvalidArgumentException $ex) {
    echo sprintf('Erro: %s in file: %s - line: %s', $ex->getMessage(), $ex->getFile(), $ex->getLine()), PHP_EOL;
}
