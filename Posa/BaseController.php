<?php
namespace Posa;

abstract class BaseController{

    protected $path;
    private $title;
    protected $res;
    protected $req;


    protected function render($path, $layout = NULL){
        $this->path = $path;
        
        if(is_null($layout)){
            $this->content();
        }
        else{
            $this->layout($layout);
        }

        return $this;
    }

    protected function with($req, $res){
        $this->req = $req;
        $this->res = $res;
        return $this;
    }

    protected function content(){
        if(file_exists(__DIR__."/../app/Views/".$this->path)){
            return require_once __DIR__."/../app/Views/". $this->path;
        }
        return $this->res->status(404);
    }    

    protected function layout($layout){
        if(file_exists(__DIR__."/../app/Views/". $layout)){
            return require_once __DIR__."/../app/Views/". $layout;
        }
        return $this->res->status(404);
    }

    protected function title($title = null){
        if(!is_null($title)){
            $this->title = $title;
        }
        return $this->title;

    }
}

?>