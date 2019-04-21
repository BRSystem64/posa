<?php
namespace Posa;



final class App  implements Interfaces\IHTTP{

    private $verb;
    private $params;
    private $find;
    private $midStack;


    public function __construct(){
        $this->verb = $_SERVER['REQUEST_METHOD'];
        $this->find = False;
        $this->midStack = new Middleware;
      }

    
    /*
      Caso não encontre nenhum caminho, entra nesse metodo
    */
    public function run(){
       if(!$this->find){
            $res = New Response;
            return $res->status(404);
       }
    }
 

    /*
        Método GET
    */
    public function get($url, $callable){
        if($this->verb === 'GET'){
            if($this->compare($this->getUrlRequest(), $url)){  
                $this->redirect($callable);
            }
        }
        $this->midStack->clear();
        return $this;
    }

    
    /*
        Método POST
    */
    public function post($url, $callable){
        if($this->verb === 'POST'){
            if($this->compare($this->getUrlRequest(), $url)){  
                $this->redirect($callable);
            }
        }
        $this->midStack->clear();
        return $this;
    }

    /*
        Método PUT
    */
    public function put($url, $callable){
        if($this->verb === 'PUT'){
            if($this->compare($this->getUrlRequest(), $url)){  
                $this->redirect($callable);
            }
        }
        $this->midStack->clear();
        return $this;
    }

    
    /*
        Método DELETE
    */
    public function delete($url, $callable){
        if($this->verb === 'DELETE'){
            if($this->compare($this->getUrlRequest(), $url)){  
                $this->redirect($callable);
            }
        }
        $this->midStack->clear();
        return $this;
    }

    /*
        Adiciona uma Middleware na Stack
    */
    public function midd($mid){
        $this->midStack->add($mid);
        return $this;
    }

    /* 
        Url desejada foi encontrada.
    */
    private function redirect($callable){
        $req = $this->defineRequest();
        
        if($this->midStack->hasMiddleware()){
            $this->midStack->execute($req, new Response);
        }
        $this->find = True;

        if(is_callable($callable)){
            return $callable($req, new Response);
        }
        else{
            $callable = explode("@", $callable);
            $controller = Container::newController($callable[0]);
            $method = $callable[1];

            return $controller->$method($req, new Response);
        }
    }
    
    /*
        Define Requisicao
    */
    private function defineRequest(){
        $req = new Request;
        $req->setHeader();
        $req->setQuery($_GET);
        array_push($_POST, json_decode(file_get_contents('php://input', true)));
        if(!is_null($_POST)){
            $req->setBody($_POST);
        }
        $req->setParams($this->params);
        return $req;
    }





    /*
        Captura a url atual.
    */
    public function getUrlRequest(){
        return $_SERVER["REQUEST_URI"];
    }




    /*
        Compara a Url desejada com a url atual no mapa de urls.
        O retorno é boolean.
    */
    private function compare($urlRquest, $url){

        $this->params = [];
        $arrayUrl = explode('/', $url);
        $arrayUrlRequest = explode('/', $urlRquest);


        if(count($arrayUrl) === count($arrayUrlRequest)){
            foreach($arrayUrl as $key => $value){
                if(substr($value, 0, 1) === ':'){
                    $arrayUrl[$key] = $arrayUrlRequest[$key];
                    $newKey = substr($value,1,strlen($value)-1);
                    $this->params[$newKey] = $arrayUrlRequest[$key];
                }
            }
             if(implode('/', $arrayUrl) === implode('/', $arrayUrlRequest)){
                return True;   
            }
        }
        return False;
    }
}




?>