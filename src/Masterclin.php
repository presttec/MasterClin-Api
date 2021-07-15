<?php

use GuzzleHttp\Client;

/**
 * Description of Masterclin
 *
 * @author Usuário
 */
class Masterclin {

    private $headers;
    private $response;
    private $token;
    private $informacoesAdicionais;

    public function __construct() {
        $this->headers = array();
        $this->token = '';
        $this->headers['Accept'] = 'application/json';
        $this->headers['Content-Type'] = 'application/json';
        $this->informacoesAdicionais = array();
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
        $this->headers['mc-api-key'] = $token;
        $this->getInformacoesAdicionais();
        return $this;
    }

    protected function configHeader($request) {
        foreach ($this->headers as $key => $value) {
            $request->setHeader($key, $value);
        }
    }

    public function initClient($url, $query) {
        return new Client([
            'defaults' => [
                'headers' => $this->headers,
                'query' => $query,
            ]
        ]);
    }

    public function sendGet($url, $query = array()) {
        $request = $client->createRequest('GET', $url, [
            'headers' => $this->headers
        ]);
        $response = $client->send($request);
        echo $response->getBody();

    }

    /*
      Retorna listagem de informações adicionais do beneficiário de acordo com cliente.
     */

    public function getInformacoesAdicionais() {
        $url = 'https://cartaomasterclin.com.br/api/v1/informacoes-adicionais';
        return $this->sendGet($url);
    }

    public function setInformacoesAdicionais($informacoesAdicionais) {
        $this->informacoesAdicionais = $informacoesAdicionais;
        return $this;
    }

}
