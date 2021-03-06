Centercob
=========

[![Build Status](https://travis-ci.org/mrprompt/Centercob.svg?branch=master)](https://travis-ci.org/mrprompt/Centercob)
[![Build Status](https://scrutinizer-ci.com/g/mrprompt/Centercob/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mrprompt/Centercob/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mrprompt/Centercob/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mrprompt/Centercob/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mrprompt/Centercob/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mrprompt/Centercob/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/mrprompt/Centercob/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

Biblioteca de integração com a Centercob por meio de troca de arquivos de remessa.

A integração possui suporte a:

- Cartão de crédito
- Débito em Conta
- Conta de Energia

## Dependências

- PHP 7.1+

## Instalação via Composer

```
composer.phar require mrprompt/centercob
```
   
## Exemplos

Os exemplos estão na pasta *samples*.

Descrição dos exemplos

    - samples/cart.php          - Array com os parâmetros necessários para cada tipo de transação
    - samples/remessa.php       - Geração de arquivo de remessa
    - samples/processado.php    - Leitura do arquivo de remessa processado
    - samples/recebido.php      - Leitura do arquivo de retorno
    
