<?php
/**
 * Dados para os exemplos
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
use MrPrompt\Centercob\Common\Base\Bank;
use MrPrompt\Centercob\Common\Base\Charge;
use MrPrompt\Centercob\Common\Base\ConsumerUnity;
use MrPrompt\Centercob\Common\Base\CreditCard;
use MrPrompt\Centercob\Common\Base\Occurrence;

/* @var $vencimento \DateTime */
$vencimento = (new DateTime())->add(new DateInterval('P30D'));

/* @var $lista array */
return [
    // Débito em conta
    [
        'cliente'           => 123, // ID na Centercob
        'vendedor'          => [
            'codigo'        => 1234, // Código de Cliente na Centercob
            'nome'          => 'NOME DA EMPRESA',
            'documento'     => '', // cpf/cnpj de cadastro do vendedor
            'nascimento'    => '01011970', // data de nascimento do vendeor
            'email'         => 'vendedor@loja.com.br', // email do vendedor
            'telefone1'     => '4811111111',
            'telefone2'     => '4822222222',
            'celular'       => '4833333333',
            'endereco'      => [
                'cidade'        => 'FLORIANOPOLIS',
                'uf'            => 'SC',
                'cep'           => '88010450',
                'logradouro'    => 'SALDANHA MARINHO',
                'numero'        => '0',
                'bairro'        => 'CENTRO',
                'complemento'   => '',
            ],
        ],
        'cobranca'          => Charge::DEBIT,
        'ocorrencia'        => Occurrence::INSERT,
        'identificador'     => 12345, // código identificador no sistema da empresa
        'autorizacao'       => 54321, // código de autorização de débito em conta
        'vencimento_util'   => true,
        'comprador'         => [
            'codigo'        => 1, // código do comprador no sistema
            'pessoa'        => 'F', // F - física / J - jurídica
            'nome'          => 'FULANO DE TAL',
            'documento'     => '11111111111', // cpf ou cnpj do comprador
            'nascimento'    => '08081974', // data de nascimento do comprador
            'email'         => 'email@comprador.com.br', // email do cliente
            'telefone1'     => '4811111111',
            'telefone2'     => '4822222222',
            'celular'       => '4833333333',
            'endereco'      => [
                'cidade'        => 'FLORIANOPOLIS',
                'uf'            => 'SC',
                'cep'           => '88010450',
                'logradouro'    => 'SALDANHA MARINHO',
                'numero'        => '0',
                'bairro'        => 'CENTRO',
                'complemento'   => '',
            ],
        ],
        'parcelas'          => [
            [
                'vencimento' => $vencimento->format('dmY'),
                'valor'      => 00.01,
                'quantidade' => 1,
            ],
        ],
        'banco'             => [
            'codigo'    => Bank::BANCO_DO_BRASIL,
            'agencia'   => 1234,
            'digito'    => 1,
            'conta'     => [
                'numero'    => '12345',
                'digito'    => '0',
                'operacao'  => '001',
                'seguro'    => false,
                'titular'   => [ // titular da conta
                    'codigo'        => 1, // código do comprador no sistema
                    'pessoa'        => 'F', // F - física / J - jurídica
                    'nome'          => 'FULANO DE TAL',
                    'documento'     => '11111111111', // cpf ou cnpj do comprador
                    'nascimento'    => '08081974', // data de nascimento do comprador
                    'email'         => 'email@comprador.com.br', // email do cliente
                    'telefone1'     => '4811111111',
                    'telefone2'     => '4822222222',
                    'celular'       => '4833333333',
                    'endereco'      => [
                        'cidade'        => 'FLORIANOPOLIS',
                        'uf'            => 'SC',
                        'cep'           => '88010450',
                        'logradouro'    => 'SALDANHA MARINHO',
                        'numero'        => '0',
                        'bairro'        => 'CENTRO',
                        'complemento'   => '',
                    ],
                ],
            ]
        ]
    ],
    // Cartão de Crédito
    [
        'cliente'           => 123, // ID na Centercob
        'vendedor'          => [
            'codigo'        => 1234, // Código de Cliente na Centercob
            'nome'          => 'NOME DA EMPRESA',
            'documento'     => '', // cpf/cnpj de cadastro do vendedor
            'nascimento'    => '01011970', // data de nascimento do vendeor
            'email'         => 'vendedor@loja.com.br', // email do vendedor
            'telefone1'     => '4811111111',
            'telefone2'     => '4822222222',
            'celular'       => '4833333333',
            'endereco'      => [
                'cidade'        => 'FLORIANOPOLIS',
                'uf'            => 'SC',
                'cep'           => '88010450',
                'logradouro'    => 'SALDANHA MARINHO',
                'numero'        => '0',
                'bairro'        => 'CENTRO',
                'complemento'   => '',
            ],
        ],
        'cobranca'          => Charge::CREDIT_CARD,
        'ocorrencia'        => Occurrence::INSERT,
        'identificador'     => 39282,
        'autorizacao'       => 32046,
        'comprador'         => [
            'codigo'        => 1, // código do comprador no sistema
            'pessoa'        => 'F', // F - física / J - jurídica
            'nome'          => 'FULANO DE TAL',
            'documento'     => '11111111111', // cpf ou cnpj do comprador
            'nascimento'    => '08081974', // data de nascimento do comprador
            'email'         => 'email@comprador.com.br', // email do cliente
            'telefone1'     => '4811111111',
            'telefone2'     => '4822222222',
            'celular'       => '4833333333',
            'endereco'      => [
                'cidade'        => 'FLORIANOPOLIS',
                'uf'            => 'SC',
                'cep'           => '88010450',
                'logradouro'    => 'SALDANHA MARINHO',
                'numero'        => '0',
                'bairro'        => 'CENTRO',
                'complemento'   => '',
            ],
        ],
        'parcelas'          => [
            [
                'vencimento' => $vencimento->format('dmY'),
                'valor'      => 00.01,
                'quantidade' => 1,
            ],
        ],
        'cartao'            => [
            'numero'        => '5488260647577915',
            'validade'      => '082018',
            'seguranca'     => '547',
            'bandeira'      => CreditCard::MASTERCARD
        ],
    ],
    [
        'cliente'           => 123, // ID na Centercob
        'vendedor'          => [
            'codigo'        => 1234, // Código de Cliente na Centercob
            'nome'          => 'NOME DA EMPRESA',
            'documento'     => '', // cpf/cnpj de cadastro do vendedor
            'nascimento'    => '01011970', // data de nascimento do vendeor
            'email'         => 'vendedor@loja.com.br', // email do vendedor
            'telefone1'     => '4811111111',
            'telefone2'     => '4822222222',
            'celular'       => '4833333333',
            'endereco'      => [
                'cidade'        => 'FLORIANOPOLIS',
                'uf'            => 'SC',
                'cep'           => '88010450',
                'logradouro'    => 'SALDANHA MARINHO',
                'numero'        => '0',
                'bairro'        => 'CENTRO',
                'complemento'   => '',
            ],
        ],
        'cobranca'          => Charge::CREDIT_CARD,
        'ocorrencia'        => Occurrence::INSERT,
        'identificador'     => 39282,
        'autorizacao'       => 32046,
        'comprador'         => [
            'codigo'        => 1, // código do comprador no sistema
            'pessoa'        => 'F', // F - física / J - jurídica
            'nome'          => 'FULANO DE TAL',
            'documento'     => '11111111111', // cpf ou cnpj do comprador
            'nascimento'    => '08081974', // data de nascimento do comprador
            'email'         => 'email@comprador.com.br', // email do cliente
            'telefone1'     => '4811111111',
            'telefone2'     => '4822222222',
            'celular'       => '4833333333',
            'endereco'      => [
                'cidade'        => 'FLORIANOPOLIS',
                'uf'            => 'SC',
                'cep'           => '88010450',
                'logradouro'    => 'SALDANHA MARINHO',
                'numero'        => '0',
                'bairro'        => 'CENTRO',
                'complemento'   => '',
            ],
        ],
        'parcelas'          => [
            [
                'vencimento' => $vencimento->format('dmY'),
                'valor'      => 00.01,
                'quantidade' => 1,
            ],
        ],
        'cartao'            => [
            'numero'        => '5390167438894648',
            'validade'      => '072017',
            'seguranca'     => '622',
            'bandeira'      => CreditCard::MASTERCARD
        ],
    ],
    // Conta de Energia
    [
        'cliente'           => 123, // ID na Centercob
        'vendedor'          => [
            'codigo'        => 1234, // Código de Cliente na Centercob
            'nome'          => 'NOME DA EMPRESA',
            'documento'     => '', // cpf/cnpj de cadastro do vendedor
            'nascimento'    => '01011970', // data de nascimento do vendeor
            'email'         => 'vendedor@loja.com.br', // email do vendedor
            'telefone1'     => '4811111111',
            'telefone2'     => '4822222222',
            'celular'       => '4833333333',
            'endereco'      => [
                'cidade'        => 'FLORIANOPOLIS',
                'uf'            => 'SC',
                'cep'           => '88010450',
                'logradouro'    => 'SALDANHA MARINHO',
                'numero'        => '0',
                'bairro'        => 'CENTRO',
                'complemento'   => '',
            ],
        ],
        'cobranca'          => Charge::ENERGY,
        'ocorrencia'        => Occurrence::INSERT,
        'identificador'     => 39282,
        'autorizacao'       => 32046,
        'comprador'         => [
            'codigo'        => 1, // código do comprador no sistema
            'pessoa'        => 'F', // F - física / J - jurídica
            'nome'          => 'FULANO DE TAL',
            'documento'     => '11111111111', // cpf ou cnpj do comprador
            'nascimento'    => '08081974', // data de nascimento do comprador
            'email'         => 'email@comprador.com.br', // email do cliente
            'telefone1'     => '4811111111',
            'telefone2'     => '4822222222',
            'celular'       => '4833333333',
            'endereco'      => [
                'cidade'        => 'FLORIANOPOLIS',
                'uf'            => 'SC',
                'cep'           => '88010450',
                'logradouro'    => 'SALDANHA MARINHO',
                'numero'        => '0',
                'bairro'        => 'CENTRO',
                'complemento'   => '',
            ],
        ],
        'parcelas'          => [
            [
                'vencimento' => $vencimento->format('dmY'),
                'valor'      => 00.01,
                'quantidade' => 1,
            ],
        ],
        'energia'           => [
            'numero'        => '001010',
            'leitura'       => '230515',
            'vencimento'    => '310515',
            'concessionaria'=> ConsumerUnity::CELESC
        ],
    ],
];