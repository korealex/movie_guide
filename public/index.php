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
        return $app->view()->show('template/search.php',['hello'=>"name "]);
    });

    $routes->get('/query',function ()use($app){
        /**
         * ('id', `firstAired`, `network`, `overview`, `seriesName`, `status`) VALUES ('82066', '2008-08-26', 'FOX (US)', 'The series follows a Federal Bureau of Investigation \\"Fringe Division\\" team based in Boston. The team uses unorthodox \\"fringe\\" science and FBI investigative techniques to investigate a series of unexplained, often ghastly occurrences, some of which are related to mysteries surrounding a parallel universe.', 'Fringe', 'Ended');
         */
        $array = [
            'id'=>887841,
            'firstAired'=>'2008-08-26',
            'network'=>'1FOX (US)',
            'overview'=> '1The series follows a Federal Bureau of Investigation \\"Fringe Division\\" team based in Boston. The team uses unorthodox \\"fringe\\" science and FBI investigative techniques to investigate a series of unexplained, often ghastly occurrences, some of which are related to mysteries surrounding a parallel universe.',
            'seriesName'=> '1Fringes',
            'status'=>'1Ended'
        ];
        $image_arr = ['id'=>144782, 'subKey'=>"12", 'fileName'=>'dsds.jpg'];
        try{
            $tv_show = new \App\Models\TvShow();
            $image = new \App\Models\Image();
            $tv_show->create($array);
            $image->create($image_arr);
            $tv_show->images()->save($image);
            $tv_show->load(['images']);

//            $id = $app->queryBuilder()->insert('tvshow',$array,'id');
//            $result = $app->queryBuilder()->where('tvshow','id','=',$id);
//            $result = $app->queryBuilder()->all('tvshow');
//            $result = $app->queryBuilder()->update('tvshow', $array, 'id',8208533);
//            $result = $app->queryBuilder()->delete('tvshow', 'id',820851);
            $tv_show->load(['images']);
            dd($tv_show);

        }catch (Exception $e){
            dd($e->getMessage());
        }

        dd($array);

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


