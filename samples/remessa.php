<?php
/**
 * Exemplo de uso
 *
 * Criação do arquivo de cadastro
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
use MrPrompt\Centercob\Common\Base\Cart;
use MrPrompt\Centercob\Common\Base\Sequence;
use MrPrompt\Centercob\Gateway\Shipment\File;

require __DIR__ . '/../bootstrap.php';

/* @var $today \DateTime */
$today      = new DateTime();

/* @var $cart \Centercob\Common\Base\Cart */
$cart       = new Cart();

/* @var $lista array */
$lista      = require __DIR__ . '/cart.php';

foreach ($lista as $linha) {
    if (in_array($linha['cobranca'], [\Centercob\Common\Base\Charge::BILLET, \Centercob\Common\Base\Charge::PAYMENT_SLIP])) {
        continue;
    }

    /* @var $item \Centercob\Gateway\Shipment\Partial\Detail */
    $item = \Centercob\Gateway\Factory::createDetailFromArray($linha);

    echo 'Tipo: ', $item->getCharge()->getCharging(), PHP_EOL;
    echo 'Comprador: ', $item->getPurchaser()->getName(), PHP_EOL;
    echo 'Parcelas: ', PHP_EOL;

    foreach ($item->getParcels() as $parcel) {
        echo '      # ', ($parcel->getKey() + 1), PHP_EOL;
        echo '     R$ ', number_format($parcel->getPrice(), 2, ',', '.'), PHP_EOL;
        echo '    Qtd ', $parcel->getQuantity(), PHP_EOL;
    }

    echo 'Status: ', $item->getCharge()->getOccurrence()->getDescription(), PHP_EOL;
    echo PHP_EOL, PHP_EOL;

    $cart->addItem($item);
}

try {
    /* @var $sequence \Centercob\Common\Base\Sequence */
    $sequence   = new Sequence(8);

    /* @var $customer \Centercob\Common\Base\Customer */
    $customer   = \Centercob\Gateway\Factory::createCustomerFromArray(array_shift($lista));

    /* @var $exporter \Centercob\Gateway\Shipment\File */
    $exporter   = new File($customer, $sequence, $today, __DIR__ . DIRECTORY_SEPARATOR . 'enviados', File::TEMPLATE_GENERATED);

    $exporter->setCart($cart);

    $result = $exporter->save();

    echo sprintf('Arquivo %s gerado com sucesso no diretório %s', basename($result), dirname($result)), PHP_EOL;
} catch (\InvalidArgumentException $ex) {
    echo sprintf('Erro: %s in file: %s - line: %s', $ex->getMessage(), $ex->getFile(), $ex->getLine()), PHP_EOL;
}
