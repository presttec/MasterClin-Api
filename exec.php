<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/src/Masterclin.php';
require_once dirname(__FILE__) . '/src/Beneficiario.php';



$masterclin = new Masterclin();
$masterclin->setToken('S0QsJJ5pXC1Se9REdKf1wl10sUGxsyEivfX9HobnJPlPT1DAm6rawC4gV196EgK3JeYZ7fPxdlhPkY2Zz9HPKKefZ1iicjxxoObP');

$beneficiario = new Beneficiario($masterclin);

$beneficiario->setCpf('000.000.000-00');
$beneficiario->setAtivo(TRUE);
$beneficiario->setCartaoValidade('2022-04-09');
$beneficiario->setNome('Nome do Beneficiário');
$beneficiario->setTelefoneCelular('(00) 0000-0000');
$beneficiario->setTelefoneResidencial('(00) 0000-0000');

$endereco = array();
$endereco['cep'] = '00000-000';
$endereco['uf'] = 'DF';
$endereco['bairro'] = '';
$endereco['logradouro'] = '';
$endereco['complemento'] = '';
$endereco['numero'] = '';
$beneficiario->setEndereco($endereco);

foreach ($informacoes_adicionais as $key => $value) {
    switch ($value) {
        case 10:
            $beneficiario->dataInformacoesAdicionais($value, 'InformacaoAdiconal');
            break;
        default:
            break;
    }
}

$beneficiario->save();


//foreach ($beneficiario->getData() as $key => $value) {
//    if (is_array($value)) {
//        foreach ($value as $skey => $svalue) {
//            echo "$key:$skey =>  $svalue\n";
//        }
//    } else {
//        echo "$key =>  $value\n";
//        
//    }
//}

$dependente = new Dependente($beneficiario);
//
$dependente->setCpf('000.000.000-00');
$dependente->setAtivo(TRUE);
$dependente->setCartaoValidade('2022-04-09');
$dependente->setNome('Nome do Dependente');
$dependente->setTelefoneCelular('(00) 0000-0000');
$dependente->setTelefoneResidencial('(00) 0000-0000');
//
$endereco = array();
$endereco['cep'] = '00000-000';
$endereco['uf'] = 'DF';
$endereco['bairro'] = '';
$endereco['logradouro'] = '';
$endereco['complemento'] = '';
$endereco['numero'] = '';
$dependente->setEndereco($endereco);
foreach ($informacoes_adicionais as $key => $value) {
    switch ($value) {
        case 10:
            $beneficiario->dataInformacoesAdicionais($value, 'InformacaoAdiconal');
            break;
        default:
            break;
    }
}

$dependente->save();
//foreach ($dependente->getData() as $key => $value) {
//    if (is_array($value)) {
//        foreach ($value as $skey => $svalue) {
//            echo "$key:$skey =>  $svalue\n";
//        }
//    } else {
//        echo "$key =>  $value\n";
//    }
//}

