<?php
session_start();
try{

    include_once ('../env.php');
    include_once ('../helpers.php');
    include_once ('../autoloader.php');
    register_shutdown_function('handleFatalPhpError');

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
    return;

}catch(Exception $e){
    (new \App\Exceptions\Handler($e))->render();
    return;
}
function handleFatalPhpError() {

    $fatal_error = error_get_last();
    if(!empty($fatal_error)){
        header('Content-Type: application/json');
        echo json_encode([
            'fatal_error'=> $fatal_error
        ]);
        return;
    }


}


