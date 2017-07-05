<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 07-04-17
 * Time: 12:12 PM
 */

namespace App\Controller;


use App\Models\Search;
use App\Models\TvShow;

class TvShowController extends MainController
{

    public function index(){
        return $this->app->view()->show('template/search.php',['hello'=>"name "]);
    }
    public function search(){
        if($this->app->request()->has('q')){
            $search_term = $this->app->request()->get('q');
            $url = "https://api.thetvdb.com/search/series?name=".urlencode($search_term);
            $header = [  'Accept: application/json' ,'Content-type: application/json','Authorization: Bearer '.getenv('TVDB_TOKEN')];
            $response = (new \App\Http\Client())->get($url,$header);


            $search = new Search();
            $results = $search->where('query',$search_term);
            if(empty($results)){
                $search_results = $search->create(['query'=>$search_term,'created_at'=> date("Y-m-d H:i:s")]);
            }else{
                $search_results = (new Search())->fill((array)$results[0]);
            }

            if(empty($response['data'])){
                header('Content-Type: application/json');
                return   json_encode(["Show not found"]);
            }else{

            }

            $response_mod = $search_results->getShows();


            if(empty($response_mod)){
                $response_mod = array_map(function ($item)use($search_results){
                    $item['banner'] = "http://thetvdb.com/banners/".$item['banner'];
                    $item['overview'] = addslashes($item['overview']);
                    $item['seriesName'] = addslashes($item['seriesName']);
                    $item['network'] = addslashes($item['network']);
                    unset($item['aliases']);
                    $show = new TvShow();
                    $result = $show->find($item['id']);
                    if(!empty($result)){
                        $result = $show->fill($result);
                    }else{
                        $result = $show->create($item);
                    }

                    if(!isset($result->toArray()['id'])){
                        dd($result);
                    }

                    $search_results->saveResults($result);

                    return $result;
                },$response['data']);
            }


             echo $this->successResponse($response_mod);
            return true;


        }else{
            header('Content-Type: application/json');
            echo   json_encode(["No query"]);
            return false;
        }

    }

}