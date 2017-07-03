<?php
session_start();
require ('../env.php');
require ('../autoloader.php');
require('../App/Container.php');
require ('../helpers.php');

    $app = new \App\Container();

    $app->getConnection('mysql');
    $app->getRequest();
//    $app->getQueryBuilder()->where();
if($app->getRequest()->has('search')){
    $url = "https://api.thetvdb.com/search/series?name=".urlencode($app->getRequest()->get('search'));
    $header = [  'Accept: application/json' ,'Content-type: application/json','Authorization: Bearer '.getenv('TVDB_TOKEN')];
    $response = (new \App\Http\Client())->get($url,$header);



    $response_mod = array_map('mapResponse',$response['data']);
    header('Content-Type: application/json');
    echo  json_encode($response_mod);
}else{
    $app->getView()->show('template/search.php',['hello'=>"name "]);
}

 function mapResponse($item){
     $item['banner'] = "http://thetvdb.com/banners/".$item['banner'];
//     $response = (new \App\Http\Client())->get($item['banner'],null, true);
//     if($response !=200){
//         $item['banner'] = '/assets/images/no-image.jpg';
//     }
     return $item;
 }



