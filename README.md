Centercob
=========

Biblioteca de integração com a Centercob por meio de troca de arquivos de remessa.

A integração possui suporte a:

- Cartão de crédito
- Débito em Conta
- Conta de Energia
   
## Exemplos
Os exemplos estão na pasta *samples*.

Descrição dos exemplos

    - samples/cart.php          - Array com os parâmetros necessários para cada tipo de transação
    - samples/remessa.php       - Geração de arquivo de remessa
    - samples/processado.php    - Leitura do arquivo de remessa processado
    - samples/recebido.php      - Leitura do arquivo de retorno

## Instalação
Após baixar o [Composer](http://www.getcomposer.org), basta rodar o *install*

```
composer.phar install --prefer-dist
```

## Rodar Exemplos
Após a instalação, você pode rodar os exemplos utilizando o servidor embutido do PHP

```
composer.phar run
```