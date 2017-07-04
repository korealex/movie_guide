<?php
session_start();
try{

    include_once ('../env.php');
    include_once ('../helpers.php');
    include_once ('../autoloader.php');

    $app = new \App\Container();

    $app->routes()->get('/',function ()use($app){
        return (new \App\Controller\TvShowController($app))->index();
    });

    $app->routes()->get('/query',function ()use($app){
        return (new \App\Controller\DBController($app))->query();
    });

    $app->routes()->get('/search',function ()use($app){
        return (new \App\Controller\TvShowController($app))->search();
    });
    

    $response = $app->routes()->run();
    echo($response);


}catch(Exception $e){
    echo $e->getMessage();
}


