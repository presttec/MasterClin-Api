<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

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
        $client = new Client([
            'base_url' => ['https://cartaomasterclin.com.br/api/{version}/', ['version' => 'v1']],
            'defaults' => [
                'headers' => $this->headers,
                'query' => $query,
            ]
        ]);
//        $client->get($url, [
//            'headers' => $this->headers,
//            'events' => [
//                'before' => function (BeforeEvent $e) {
//                    echo 'Before';
//                },
//                'complete' => function (CompleteEvent $e) {
//                    echo 'Complete';
//                },
//                'error' => function (ErrorEvent $e) {
//                    echo 'Error';
//                },
//            ]
//        ]);
        $res = $client->get($url, [
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept' => 'application/json',
                'mc-api-key' => $this->token,
            ]
        ]);
        echo $res->getBody();
        echo $res->getStatusCode();
        // 'mc-api-key'] = $token
        //$client->get($url);
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
