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
    $url = "https://api.thetvdb.com/search/series?name=".$app->getRequest()->get('search');
    $header = [  'Accept: application/json' ,'Content-type: application/json','Authorization: Bearer '.getenv('TVDB_TOKEN')];
    $response = (new \App\Http\Client())->get($url,$header);
    dd($response);
}
$app->getView()->show('template/search.php',['hello'=>"name "]);



