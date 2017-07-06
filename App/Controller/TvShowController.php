<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 07-04-17
 * Time: 12:12 PM
 */

namespace App\Controller;


use App\Models\Episode;
use App\Models\Image;
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

            $response= null;

            $search = new Search();
            $results = $search->where('query',$search_term);

            if(empty($results)){
                $response = (new \App\Http\Client())->get($url,$header);
                $search_results = $search->create(['query'=>$search_term,'created_at'=> date("Y-m-d H:i:s")]);
                if(isset($response['Error'])){
                    header('Content-Type: application/json');
                    echo   json_encode($response);
                    return ;
                }else{
                    $response_mod = array_map(function ($item)use($search_results,$header){
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

                        $search_results->saveResults($result);

                        return $result;
                    },$response['data']);
                }

            }else{
                $search_results = (new Search())->fill((array)$results[0]);
            }
            if(empty($response_mod)){
                $response_mod = $search_results->getShows();
            }

            if(empty($response['data']) && empty($response_mod)){
                header('Content-Type: application/json');
                echo   json_encode(["Error"=>"Resource not found"]);
                return ;
            }

             echo $this->successResponse($response_mod);
            return true;


        }else{
            header('Content-Type: application/json');
            echo   json_encode(["Error"=>"No Query"]);
            return false;
        }

    }


    public function episodes(){

        if($this->app->request()->has('id')){
            $id = $this->app->request()->get('id');
            $url = "https://api.thetvdb.com/series/{$id}/episodes";
            $header = [  'Accept: application/json' ,'Content-type: application/json','Authorization: Bearer '.getenv('TVDB_TOKEN')];

            $response= null;

            $tv_show_obj =new TvShow();
            $tv_show = $tv_show_obj->find($id);



            if(empty($tv_show)){
                header('Content-Type: application/json');
                echo   json_encode(["Error"=>"No tv show found."]);
                return ;
            }
            $tv_show = $tv_show_obj->fill($tv_show);

            if(!isset($tv_show->toArray()['imdbId']) || empty($tv_show->toArray()['imdbId'])){

                $url_details = "https://api.thetvdb.com/series/".$id;
                $response = (array)(new \App\Http\Client())->get($url_details,$header)['data'];
                $item = ['imdbId'=> addslashes($response['imdbId']),
                    'zap2itId'=> addslashes($response['zap2itId']),
                    'rating' => addslashes($response['rating']),
                    'airsDayOfWeek' => addslashes($response['airsDayOfWeek']),
                    'airsTime'=> addslashes($response['airsTime']),
                    'id'=>$response['id']
                    ];


                $tv_show = $tv_show_obj->fill($tv_show_obj->find($tv_show->update($item)));
            }


            $episode = new Episode();
            $results = $episode->where('show_id',$id);


            if(empty($results)){
                $response = (new \App\Http\Client())->get($url,$header);

                if(isset($response['Error'])){
                    header('Content-Type: application/json');
                    echo   json_encode($response);
                    return ;
                }else{
                    $response_mod = array_map(function ($item)use($tv_show){
                        /**
                         * @var $tv_show TvShow
                         */
                        unset($item['language']);
                        $item['absoluteNumber'] = intval($item['absoluteNumber'])  ;
                        $item['airedEpisodeNumber'] = intval($item['airedEpisodeNumber'])  ;
                        $item['airedSeason'] = intval($item['airedSeason'])  ;
                        $item['airedSeasonID'] = intval($item['airedSeasonID'])  ;
                        $item['dvdEpisodeNumber'] = intval($item['dvdEpisodeNumber'])  ;
                        $item['dvdSeason'] = intval($item['dvdSeason'])  ;
                        $item['lastUpdated'] = intval($item['lastUpdated'])  ;
                        $item['overview'] = addslashes($item['overview']);
                        $item['episodeName'] = addslashes($item['episodeName']);

                        $episode = new Episode();
                        $result = $episode->find($item['id']);
                        if(!empty($result)){
                            $result = $episode->fill($result);
                        }else{
                            $result = $episode->create($item);
                        }

                        $tv_show->episodes()->save($result);

                        return $result;
                    },$response['data']);
                }

            }else{
                $response_mod = array_map(function ($item){
                    return (new Episode())->fill((array)$item);

                },$results);
            }


            if(empty($response['data']) && empty($response_mod)){
                header('Content-Type: application/json');
                echo   json_encode(["Error"=>"Resource not found"]);
                return ;
            }
            $tv_show->setAttribute('episodes',$response_mod);

            echo $this->successResponse($tv_show->toArray());
            return true;


        }else{
            header('Content-Type: application/json');
            echo   json_encode(["Error"=>"No Query"]);
            return false;
        }

    }


    public function images(){

        if($this->app->request()->has('id')){
            $type = ($this->app->request()->has('type'))?$this->app->request()->get('type'): 'fanart';
            $id = $this->app->request()->get('id');
            $url = "https://api.thetvdb.com/series/{$id}/images/query?keyType={$type}";
            $header = [  'Accept: application/json' ,'Content-type: application/json','Authorization: Bearer '.getenv('TVDB_TOKEN')];

            $response= null;

            $tv_show_obj =new TvShow();
            $tv_show = $tv_show_obj->find($id);

            if(empty($tv_show)){
                header('Content-Type: application/json');
                echo   json_encode(["Error"=>"No tv show found."]);
                return ;
            }
            $tv_show = $tv_show_obj->fill($tv_show);
            $image = new Image();
            $results = $image->whereRaw("show_id = {$id} AND keyType = '{$type}'");


            if(empty($results)){

                $response = (new \App\Http\Client())->get($url,$header);

                if(isset($response['Error'])){
                    header('Content-Type: application/json');
                    echo   json_encode($response);
                    return ;
                }else{
                    $response_mod = array_map(function ($item)use($tv_show){
                        /**
                         * @var $tv_show TvShow
                         */
                        unset($item['ratingsInfo']);
                        unset($item['thumbnail']);
                        $item['fileName'] = "http://thetvdb.com/banners/{$item['fileName']}";


                        $image = new Image();
                        $result = $image->find($item['id']);
                        if(!empty($result)){
                            $result = $image->fill($result);
                        }else{
                            $result = $image->create($item);
                        }

                        $tv_show->images()->save($result);

                        return $result;
                    },$response['data']);
                }

            }else{

                $response_mod = array_map(function ($item){
                    return (new Image())->fill((array)$item);

                },$results);

            }


            if(empty($response['data']) && empty($response_mod)){
                header('Content-Type: application/json');
                echo   json_encode(["Error"=>"Resource not found"]);
                return ;
            }

            echo $this->successResponse($response_mod);
            return true;


        }else{
            header('Content-Type: application/json');
            echo   json_encode(["Error"=>"No Query"]);
            return false;
        }

    }


}