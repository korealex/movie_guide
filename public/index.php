<?php
session_start();
include_once ('../env.php');
include_once ('../autoloader.php');
include_once('../App/Container.php');
include_once ('../helpers.php');

$app = new \App\Container();

//    $app->connection('mysql');
//    $app->getQueryBuilder()->where();
if($app->request()->has('search')){
    $url = "https://api.thetvdb.com/search/series?name=".urlencode($app->request()->get('search'));
    $header = [  'Accept: application/json' ,'Content-type: application/json','Authorization: Bearer '.getenv('TVDB_TOKEN')];
    $response = (new \App\Http\Client())->get($url,$header);



    $response_mod = array_map('mapResponse',$response['data']);
    header('Content-Type: application/json');
    echo  json_encode($response_mod);
}elseif ($app->request()->has('query')){

    /**
     * ('id', `firstAired`, `network`, `overview`, `seriesName`, `status`) VALUES ('82066', '2008-08-26', 'FOX (US)', 'The series follows a Federal Bureau of Investigation \\"Fringe Division\\" team based in Boston. The team uses unorthodox \\"fringe\\" science and FBI investigative techniques to investigate a series of unexplained, often ghastly occurrences, some of which are related to mysteries surrounding a parallel universe.', 'Fringe', 'Ended');
     */
    $array = [
        'id'=>82085383,
        'firstAired'=>'2008-08-26',
        'network'=>'1FOX (US)',
        'overview'=> '1The series follows a Federal Bureau of Investigation \\"Fringe Division\\" team based in Boston. The team uses unorthodox \\"fringe\\" science and FBI investigative techniques to investigate a series of unexplained, often ghastly occurrences, some of which are related to mysteries surrounding a parallel universe.',
        'seriesName'=> '1Fringes',
        'status'=>'1Ended'
    ];
        try{
            $tv_show = new \App\Models\TvShow();
//            $id = $app->queryBuilder()->insert('tvshow',$array,'id');
//            $result = $app->queryBuilder()->where('tvshow','id','=',$id);
//            $result = $app->queryBuilder()->all('tvshow');
//            $result = $app->queryBuilder()->update('tvshow', $array, 'id',8208533);
//            $result = $app->queryBuilder()->delete('tvshow', 'id',820851);
            dd($tv_show->find(82085383));

        }catch (Exception $e){
            dd($e->getMessage());
        }

    dd($array);

} else{
    $app->view()->show('template/search.php',['hello'=>"name "]);
}

 function mapResponse($item){
     $item['banner'] = "http://thetvdb.com/banners/".$item['banner'];
//     $response = (new \App\Http\Client())->get($item['banner'],null, true);
//     if($response !=200){
//         $item['banner'] = '/assets/images/no-image.jpg';
//     }
     return $item;
 }



