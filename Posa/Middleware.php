<?php

namespace Posa;

class Middleware{

    private $stackMiddleware ;

    public function __construct(){
        $this->stackMiddleware = [];
    }

    public function add($middleware){
        array_push($this->stackMiddleware, $middleware);
    }

    public function clear(){
        $this->stackMiddleware = [];
    }

    public  function execute($req, $res){

       foreach($this->stackMiddleware as $middleware){
           array_pop($this->stackMiddleware);
           if(is_callable($middleware)){
                $middleware($req, $res);
           }
           else{
                $callable = explode("@", $middleware);
                $controller = Container::newController($callable[0]);
                $method = $callable[1];

                return $controller->$method($req, new Response);
           }
       }

       return $this;
    }

    public function hasMiddleware(){
        return !is_null($this->stackMiddleware) ? True : False;
    }
}

?>