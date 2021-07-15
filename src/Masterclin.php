<?php

require_once dirname(__FILE__) . '/WEB.php';

/**
 * Description of Masterclin
 *
 * @author Usuário
 */
class Masterclin extends Web {

    private $token;

    public function __construct() {
        parent::__construct();
        $this->token = '';
        $this->headers['Accept'] = 'application/json';
        $this->headers['Content-Type'] = 'application/json';
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
        $this->headers['mc-api-key'] = $token;
        return $this;
    }

    /*
      Retorna listagem de informações adicionais do beneficiário de acordo com cliente.
     */

    public function informacoes_adicionais() {
        $url = 'https://cartaomasterclin.com.br/api/v1/informacoes-adicionais';
        return $this->sendGet($url);
    }

}
