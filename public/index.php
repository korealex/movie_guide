<?php
session_start();
try{

    include_once ('../env.php');
    include_once ('../autoloader.php');
    include_once('../App/Container.php');
    include_once ('../helpers.php');

    $app = new \App\Container();
    $routes = new \App\Http\Router();

    $routes->get('/',function ()use($app){
        return (new \App\Controller\TvShowController($app))->index();
    });

    $routes->get('/query',function ()use($app){
        return (new \App\Controller\DBController($app))->query();
    });

    $routes->get('/search',function ()use($app){
        if($app->request()->has('q')){
            $url = "https://api.thetvdb.com/search/series?name=".urlencode($app->request()->get('q'));
            $header = [  'Accept: application/json' ,'Content-type: application/json','Authorization: Bearer '.getenv('TVDB_TOKEN')];
            $response = (new \App\Http\Client())->get($url,$header);

            $response_mod = array_map(function ($item){
                $item['banner'] = "http://thetvdb.com/banners/".$item['banner'];
                return $item;
            },$response['data']);
            header('Content-Type: application/json');
            return   json_encode($response_mod);


        }else{
            header('Content-Type: application/json');
            return   json_encode([""]);
        }
    });

    $routes->get('/tv-shows/id',function ($params =3){
        return $params;
    });


    $response = $routes->run();
    echo($response);



}catch(Exception $e){
    echo $e->getMessage();
}


