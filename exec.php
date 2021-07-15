<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/src/Masterclin.php';
require_once dirname(__FILE__) . '/src/Beneficiario.php';



$masterclin = new Masterclin();
$masterclin->setToken('S0QsJJ5pXC1Se9REdKf1wl10sUGxsyEivfX9HobnJPlPT1DAm6rawC4gV196EgK3JeYZ7fPxdlhPkY2Zz9HPKKefZ1iicjxxoObP');

$beneficiario = new Beneficiario();

$beneficiario->setCpf('001.886.275-61');
$beneficiario->setAtivo(TRUE);
$beneficiario->setCartaoValidade('2022-04-09');
$beneficiario->setNome('Nome do Beneficiário');
$beneficiario->setTelefoneCelular('(00) 0000-0000');
$beneficiario->setTelefoneResidencial('(00) 0000-0000');

