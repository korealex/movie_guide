<?php
session_start();
try{

    /**
     * app starts
     * loads environment files
     */
    include_once ('../env.php');
    /**
     * loads helpers for general purposes
     */
    include_once ('../helpers.php');
    /**
     * Loads namespace clasess to be used in the system
     */
    include_once ('../autoloader.php');
    /**
     * register fatal error handler
     */
    register_shutdown_function('handleFatalPhpError');

    /**
     * Initialize Container Object:
     * the container object is the main app that has all the objects needed
     * for every request, such as the: Request, View, Routes among many other
     */
    $app = new \App\Container();


    /**
     * once there is an instance of the Container, since the container initializes the Router
     * we can now register the routues/uris the sistem will respond to
     */
    $app->routes()->get('/',function ()use($app){
        return (new \App\Controller\TvShowController($app))->index();
    });
    $app->routes()->post('/',function ()use($app){
        return (new \App\Controller\TvShowController($app))->index();
    });

    $app->routes()->get('/query',function ()use($app){
        return (new \App\Controller\DBController($app))->query();
    });

    $app->routes()->get('/search',function ()use($app){
        return (new \App\Controller\TvShowController($app))->search();
    });

    $app->routes()->get('/episodes',function ()use($app){
        return (new \App\Controller\TvShowController($app))->episodes();
    });

    $app->routes()->get('/images',function ()use($app){
        return (new \App\Controller\TvShowController($app))->images();
    });

    /**
     * here the routes are executed, if there is a matching route the router will be executed
     * using a call back function that may return a controller
     */
    $response = $app->routes()->run();
    return;

}catch(Exception $e){
    /**
     * render exceptions
     */
    (new \App\Exceptions\Handler($e))->render();
    return;
}
function handleFatalPhpError() {
    /**
     * handle fatal errors
     */

    $fatal_error = error_get_last();
    if(!empty($fatal_error)){
        header('Content-Type: application/json');
        echo json_encode([
            'fatal_error'=> $fatal_error
        ]);
        return;
    }


}


