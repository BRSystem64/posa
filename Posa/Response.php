<?php
namespace Posa;


class Response{


    public function status($status){
        header("HTTP/1.1 ". $status);
        return $this;
    }

    public function send($json){
        header("Content-type:application/json");
        echo json_encode($json);
        return $this;
    }

}

?>