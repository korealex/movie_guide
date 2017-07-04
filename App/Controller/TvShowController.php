<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 07-04-17
 * Time: 12:12 PM
 */

namespace App\Controller;


use App\Models\TvShow;

class TvShowController extends MainController
{

    public function index(){
        return $this->app->view()->show('template/search.php',['hello'=>"name "]);
    }
    public function search(){
        if($this->app->request()->has('q')){
            $url = "https://api.thetvdb.com/search/series?name=".urlencode($this->app->request()->get('q'));
            $header = [  'Accept: application/json' ,'Content-type: application/json','Authorization: Bearer '.getenv('TVDB_TOKEN')];
            $response = (new \App\Http\Client())->get($url,$header);

            $response_mod = array_map(function ($item){
                $item['banner'] = "http://thetvdb.com/banners/".$item['banner'];
                return new TvShow($item);
            },$response['data']);
            return $this->successResponse($response_mod);


        }else{
            header('Content-Type: application/json');
            return   json_encode(["No query"]);
        }

    }

}