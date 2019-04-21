<?php

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../Posa/App.php";


$app = new Posa\App;

$app->midd(function($res, $req){
    echo "mid first";
    $x = False;

    if(!$x){
        return False;
    }

})->get('/Posa/public/home/','HomeController@index');

$app->get('/Posa/public/usuario/:nome', function($req, $res){
    echo "bem vindo, ". $req->params['nome'];

    return $res;
});


$app->run();
?>


