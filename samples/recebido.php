<?php
/**
 * Exemplo de uso
 *
 * Criação do arquivo de cadastro
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
use MrPrompt\Centercob\Factory;
use MrPrompt\Centercob\Received\File;

require __DIR__ . '/../bootstrap.php';

/* @var $lista array */
$lista      = require __DIR__ . '/cart.php';

try {
    /* @var $customer \MrPrompt\ShipmentCommon\Base\Customer */
    $customer   = Factory::createCustomerFromArray(array_shift($lista));
    $date       = new DateTime('2015-05-19 18:54:42');

    $importer   = new File($customer, $date, __DIR__ . '/recebidos');
    $cart       = $importer->getCart();

    /* @var $item \MrPrompt\Centercob\Received\Partial\Detail */
    foreach ($cart as $item) {
        echo 'Comprador: ', $item->getPurchaser()->getName(), PHP_EOL;
        echo 'Documento: ', $item->getPurchaser()->getDocument()->getNumber(), PHP_EOL;
        echo 'Parcela  : ', PHP_EOL;
        echo '         # ', ($item->getParcel()->getKey() + 1), PHP_EOL;
        echo '        R$ ', number_format($item->getParcel()->getPrice(), 2, ',', '.'), PHP_EOL;
        echo 'Vencimento ', $item->getParcel()->getMaturity()->format('d/m/Y'), PHP_EOL;
        echo PHP_EOL, PHP_EOL;
    }
} catch (\InvalidArgumentException $ex) {
    echo sprintf('Erro: %s in file: %s - line: %s', $ex->getMessage(), $ex->getFile(), $ex->getLine()), PHP_EOL;
}
