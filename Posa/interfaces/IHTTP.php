<?php

namespace Posa\Interfaces;

interface IHTTP{

    public function get($url, $callable);
    public function post($url, $callable);
    public function put($url, $callable);
    public function delete($url, $callable);

}

?>