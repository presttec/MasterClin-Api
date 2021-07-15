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


    public function sendGet($url, $query = array()) {
        $client = new Client();

        $res = $client->get($url, [
            'headers' => [
                'Accept' => 'application/json',
                'mc-api-key' => $this->token,
            ]
        ]);
        return json_decode($res->getBody(), TRUE);
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

    /*
      Retorna listagem de beneficiários do cliente.
     */

    public function list_beneficiarios($params = array()) {
        $url = 'https://cartaomasterclin.com.br/api/v1/beneficiarios';
        return $this->sendGet($url . '?' . http_build_query($params));
    }

    /*
      Exibe dados completos do beneficiário em específico.
     */

    public function get_beneficiarios($id) {
        $url = 'https://cartaomasterclin.com.br/api/v1/beneficiarios/' . $id;
        return $this->sendGet($url);
    }

    /*
      Cadastra novo beneficiário para cliente.
     */

    public function save_beneficiarios($data) {
        $url = 'https://cartaomasterclin.com.br/api/v1/beneficiarios';
        return $this->sendPost($url, $data);
    }

    /*
      Atualiza os dados do beneficiário.
     */

    public function update_beneficiarios($id, $data) {
        $url = 'https://cartaomasterclin.com.br/api/v1/beneficiarios/' . $id;
        return $this->sendPutJson($url, $data);
    }

    /*
      Retorna listagem de beneficiários dependentes.
     */

    public function list_dependentes($beneficiario_id, $params = array()) {
        $url = 'https://cartaomasterclin.com.br/api/v1/beneficiarios/' . $beneficiario_id . '/dependentes';
        return $this->sendGet($url, $params);
    }

    /*
      Cadastra novo beneficiário dependente.
     */

    public function save_dependentes($beneficiario_id, $params = array()) {
        $url = 'https://cartaomasterclin.com.br/api/v1/beneficiarios/' . $beneficiario_id . '/dependentes';
        return $this->sendPostJson($url, $params);
    }

    /*
      Atualiza os dados do dependente.
     */

    public function update_dependentes($beneficiario_id, $dependente_id, $params = array()) {
        $url = 'https://cartaomasterclin.com.br/api/v1/beneficiarios/' . $beneficiario_id . '/dependentes/' . $dependente_id;
        return $this->sendPutJson($url, $params);
    }

    /*
      Exclui beneficiário dependente.
     */

    public function del_dependentes($beneficiario_id, $dependente_id, $params = array()) {
        $url = 'https://cartaomasterclin.com.br/api/v1/beneficiarios/' . $beneficiario_id . '/dependentes/' . $dependente_id;
        return $this->sendDelete($url, $params);
    }

    /*
      Emite imagem do cartão do beneficiário
     */

    public function emitir_cartao($beneficiario_id) {
        $url = 'https://cartaomasterclin.com.br/api/v1/beneficiarios/' . $beneficiario_id . '/emitir-cartao';
        return $this->sendGet($url);
    }

    /*
      Retorna os dados dos parceiros
     */

    public function list_parceiro() {
        $url = 'https://cartaomasterclin.com.br/api/v1/parceiro/';
        return $this->sendGet($url);
    }

    /*
      Retorna todos parceiros selecionados como Destaque.
     */

    public function list_parceiros_destaques() {
        $url = 'https://cartaomasterclin.com.br/api/v1/parceiro/obter-destaques';
        return $this->sendGet($url);
    }

    /*
      Retorna dados do parceiro em especifico.
     */

    public function get_parceiro($id) {
        $url = 'https://cartaomasterclin.com.br/api/v1/parceiro/' . $id;
        return $this->sendGet($url);
    }

    /*
      Retorna dados de unidades de um parceiro em especifico.
     */

    public function get_parceiro_unidades($id) {
        $url = 'https://cartaomasterclin.com.br/api/v1/parceiro/' . $id . '/unidades';
        return $this->sendGet($url);
    }

    /*
      Retorna listagem de estados.
     */

    public function get_endereco_estados() {
        $url = 'https://cartaomasterclin.com.br/api/v1/endereco/estados';
        return $this->sendGet($url);
    }

    /*
      Retorna listagem de Cidades de acordo com Estado especificado.
     */

    public function get_endereco_cidades($estado_id) {
        $url = 'https://cartaomasterclin.com.br/api/v1/endereco/estados/' . $estado_id . '/cidades';
        return $this->sendGet($url);
    }

    /*
      Retorna listagem de Bairros de acordo com Cidade especificada.
     */

    public function get_endereco_bairros($cidade_id) {
        $url = 'https://cartaomasterclin.com.br/api/v1/endereco/cidades/' . $cidade_id . '/bairros';
        return $this->sendGet($url);
    }

    /*
      Retorna dados de um bairro em específico por identificador.
     */

    public function get_bairros($bairro_id) {
        $url = 'https://cartaomasterclin.com.br/api/v1/endereco/bairros/' . $bairro_id;
        return $this->sendGet($url);
    }

}
