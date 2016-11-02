Centercob
=========

[![Build Status](https://travis-ci.org/mrprompt/Centercob.svg?branch=master)](https://travis-ci.org/mrprompt/Centercob)
[![Code Climate](https://codeclimate.com/github/mrprompt/Centercob/badges/gpa.svg)](https://codeclimate.com/github/mrprompt/Centercob)
[![Test Coverage](https://codeclimate.com/github/mrprompt/Centercob/badges/coverage.svg)](https://codeclimate.com/github/mrprompt/Centercob/coverage)
[![Issue Count](https://codeclimate.com/github/mrprompt/Centercob/badges/issue_count.svg)](https://codeclimate.com/github/mrprompt/Centercob)

Biblioteca de integração com a Centercob por meio de troca de arquivos de remessa.

A integração possui suporte a:

- Cartão de crédito
- Débito em Conta
- Conta de Energia

## Dependências

- PHP 5.6
   
## Exemplos

Os exemplos estão na pasta *samples*.

Descrição dos exemplos

    - samples/cart.php          - Array com os parâmetros necessários para cada tipo de transação
    - samples/remessa.php       - Geração de arquivo de remessa
    - samples/processado.php    - Leitura do arquivo de remessa processado
    - samples/recebido.php      - Leitura do arquivo de retorno
    
## Instalação via Composer

```
composer.phar require mrprompt/centercob
```
