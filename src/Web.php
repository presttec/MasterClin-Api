<?php

/**
 * Description of Masterclin
 *
 * @author Usuário
 */
class Web {

    protected $ch;
    protected $data;
    protected $headers;
    protected $response;
    protected $client;

    public function __construct() {
        $this->clearHeader();
    }

    public function getCh() {
        return $this->ch;
    }

    public function getData() {
        return $this->data;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function getResponse() {
        return $this->response;
    }

    public function setCh($ch) {
        $this->ch = $ch;
        return $this;
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    public function setHeaders($headers) {
        $this->headers = $headers;
        return $this;
    }

    public function setResponse($response) {
        $this->response = $response;
        return $this;
    }

    public function clearHeader() {
        $this->headers = array();
    }


    public function configHeader() {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
    }

    private function initCurl($url) {
        $this->client = curl_init($url);


        curl_setopt($this->client, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($this->client, CURLOPT_SSL_VERIFYPEER, FALSE);

        curl_setopt($this->client, CURLOPT_RETURNTRANSFER, true);


        curl_setopt($this->client, CURLOPT_HEADER, TRUE);
        curl_setopt($this->client, CURLOPT_HTTPHEADER, $this->headers);

        $fp = fopen(dirname(__FILE__) . '/errorlog.txt', 'w');

        curl_setopt($this->client, CURLOPT_VERBOSE, 1);
        curl_setopt($this->client, CURLOPT_STDERR, $fp);
    }

    private function closeCurl() {
        $this->response = curl_exec($this->client);
        $this->info = curl_getinfo($this->client);
        print_r($this->info);
        echo "response:" . $this->response . "\n";
        echo "http_code:" . $this->info['http_code'];
        curl_close($this->client);
    }

    public function sendDelete($url) {
        $this->initCurl($url);
        curl_setopt($this->client, CURLOPT_CUSTOMREQUEST, "DELETE");
        $this->closeCurl();
        return json_decode($this->response, TRUE);
    }

    public function sendGet($url) {
        $this->initCurl($url);
        $this->closeCurl();
        return json_decode($this->response, TRUE);
    }

    public function sendPost($url, $params) {
        $this->initCurl($url);
        curl_setopt($this->client, CURLOPT_POSTFIELDS, http_build_query($params));
        $this->closeCurl();
        return json_decode($this->response, TRUE);
    }

    public function sendPostJson($url, $params) {
        $this->initCurl($url);
        curl_setopt($this->client, CURLOPT_POSTFIELDS, json_encode($params));
        $this->closeCurl();
        return json_decode($this->response, TRUE);
    }

    public function sendPut($url, $params) {
        $this->initCurl($url);
        curl_setopt($this->client, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($this->client, CURLOPT_CUSTOMREQUEST, "PUT");
        $this->closeCurl();
        return json_decode($this->response, TRUE);
    }

    public function sendPutJson($url, $params) {
        $this->initCurl($url);
        curl_setopt($this->client, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($this->client, CURLOPT_CUSTOMREQUEST, "PUT");
        $this->closeCurl();
        return json_decode($this->response, TRUE);
    }

}
