<?php

namespace Posa;


final class Request{
    private $header;
    public $body;
    public $params;
    private $query;
    private $auth;

    public function __construct(){
        $this->body = json_decode(file_get_contents('php://input', true));
    }


    public function setHeader($header = NULL){
        $this->header = $header;
    }

    public function setBody($body = NULL){
        $this->body = $body;
    }

    public function setParams($params = NULL){
        $this->params = $params;
    }

    public function setQuery($query = NULL){
        $this->query = $query;
    }

    public function setAuth($auth = NULL){
        $this->auth = $auth;
    }

}

?>