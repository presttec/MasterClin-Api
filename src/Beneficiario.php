<?php

require_once dirname(__FILE__) . '/Dao.php';

/**
 * Description of Beneficiario
 *
 * @author Usuário
 */
class Beneficiario extends Dao {

    private $id;
    private $informacoesAdicionais;
    private $codigoCliente;
    private $codigoTitular;

    public function __construct($client) {
        parent::__construct($client);
        $this->clear();
        $this->informacoesAdicionais = $client->get
    }

    public function clear() {
        $this->data = array();
        $this->data['cartao'] = array();
        $this->data['telefone'] = array();
        $this->data['endereco'] = array();
        $this->data['usuario'] = array();
        $this->clearInformacoesAdicionais();
        $this->id = '0';
    }

    public function processData($res) {
        foreach ($res as $key => $value) {
            $this->data[$key] = $value;
        }
        $this->id = $this->data['id'];
        $this->processCodigo();
    }

    public function clearInformacoesAdicionais() {
        $this->informacoesAdicionais = array();
    }

    public function dataInformacoesAdicionais($id, $value) {
        $info['id'] = $id;
        $info['valor'] = $value;
        $this->informacoesAdicionais[] = $info;
    }

    public function setInformacoesAdicionais($value) {
        $this->informacoesAdicionais = $value;
    }

    public function getInformacoesAdicionais() {
        return $this->informacoesAdicionais;
    }

    public function setCpf($value) {
        $this->clear();
        $this->data['cpf'] = $value;
        $tmpData = $this->web->list_beneficiarios(array('cpf' => $value));
        print_r($tmpData);
        die();
        if ($tmpData['total'] >= 1) {
            $this->processData($tmpData['dados'][0]);
        }
    }

    public function getCpf() {
        return $this->data['cpf'];
    }

    public function setAtivo($value) {
        $this->data['ativo'] = $value;
    }

    public function getAtivo() {
        return $this->data['ativo'];
    }

    public function setCartaoValidade($value) {
        $this->data['cartao']['validade'] = $value;
    }

    public function getCartaoValidade($value) {
        return $this->data['cartao']['validade'];
    }

    public function setNome($value) {
        $this->data['nome'] = $value;
    }

    public function getNome() {
        return $this->data['nome'];
    }

    public function setTelefone($telefones) {
        foreach ($telefones as $key => $value) {
            $this->data['telefone'][$key] = $value;
        }
    }

    public function getTelefone() {
        return $this->data['telefone'];
    }

    public function setTelefoneCelular($value) {
        $this->data['telefone']['celular'] = $value;
    }

    public function getTelefoneCelular() {
        return $this->data['telefone']['celular'];
    }

    public function setTelefoneResidencial($value) {
        $this->data['telefone']['residencial'] = $value;
    }

    public function getTelefoneResidencial() {
        return $this->data['telefone']['residencial'];
    }

    public function setEndereco($endereco) {
        foreach ($endereco as $key => $value) {
            $this->data['$endereco'][$key] = $value;
        }
    }

    public function getEndereco() {
        return $this->data['$endereco'];
    }

    public function getEnderecoCep() {
        return $this->data['endereco']['cep'];
    }

    public function setEnderecoCep($value) {
        $this->data['endereco']['cep'] = $value;
    }

    public function getEnderecoUf() {
        return $this->data['endereco']['uf'];
    }

    public function setEnderecoUf($value) {
        $this->data['endereco']['uf'] = $value;
    }

    public function getEnderecoBairro() {
        return $this->data['endereco']['bairro'];
    }

    public function setEnderecoBairro($value) {
        $this->data['endereco']['bairro'] = $value;
    }

    public function getEnderecoLogradouro() {
        return $this->data['endereco']['logradouro'];
    }

    public function setEnderecoLogradouro($value) {
        $this->data['endereco']['logradouro'] = $value;
    }

    public function getEnderecoComplemento() {
        return $this->data['endereco']['complemento'];
    }

    public function setEnderecoComplemento($value) {
        $this->data['endereco']['complemento'] = $value;
    }

    public function getEnderecoNumero() {
        return $this->data['endereco']['numero'];
    }

    public function setEnderecoNumero($value) {
        $this->data['endereco']['numero'] = $value;
    }

    public function setUsuario($params) {
        $this->data['usuario'] = $params;
    }

    public function getUsuario() {
        return $this->data['usuario'];
    }

    public function getUsuarioEmail() {
        return $this->data['usuario']['email'];
    }

    public function setUsuarioEmail($value) {
        $this->data['usuario']['email'] = $value;
    }

    public function getUsuarioSenha() {
        return $this->data['usuario']['senha'];
    }

    public function setUsuarioSenha($value) {
        $this->data['usuario']['senha'] = $value;
    }

    public function getId() {
        return $this->id;
    }

    public function processCodigo() {
        $tmp = explode('/', $this->data['cartao']['codigo']);
        $this->codigoCliente = $tmp[0];
        $this->codigoTitular = $tmp[1];
        return $this;
    }

    public function getCodigoCliente() {
        return $this->codigoCliente;
    }

    public function getCodigoTitular() {
        return $this->codigoTitular;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setCodigoCliente($codigoCliente) {
        $this->codigoCliente = $codigoCliente;
        return $this;
    }

    public function setCodigoTitular($codigoTitular) {
        $this->codigoTitular = $codigoTitular;
        return $this;
    }

    public function save() {
        if ($this->id == 0) {
            $res = $this->web->save_beneficiarios($this->data);
            $this->processData($res);
        } else {
            $res = $this->web->update_beneficiarios($this->id, $this->data);
            $this->processData($res['dados'][0]);
        }
        return $this->data['cartao']['codigo'];
    }

}
