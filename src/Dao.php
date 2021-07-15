<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dao
 *
 * @author Usuário
 */
class Dao {

    protected $web;
    protected $data;

    public function __construct($client) {
        $this->web = $client;
    }

    public function getWeb() {
        return $this->web;
    }

    public function getData() {
        return $this->data;
    }

    public function setWeb($web) {
        $this->web = $web;
        return $this;
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    public function setValue($key, $value) {
        $this->data[$key] = $value;
        return $this;
    }

}
