<?php namespace App\Models;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 07-03-17
 * Time: 11:49 PM
 */
class Search extends BaseModel
{
    protected $table  = 'search';
    protected $fillable  = ['query','created_at'];

    public function shows(){
        return $this->hasManyThrough(TvShow::class,SearchShow::class,'search_id','show_id');
    }

    public function saveResults( TvShow $show){

        if(!isset($show->toArray()['id'])){
            dd($show);
        }
        $pivot = (new SearchShow())->whereRaw("search_id = {$this->toArray()['id']} AND show_id = {$show->toArray()['id']} ");
        if(empty($pivot)){
            $pivot = (new SearchShow())->create(['search_id'=>$this->toArray()['id'], 'show_id'=>$show->toArray()['id']]);
        }
        return $pivot;
    }

    public function getShows(){
        $pivots = (new SearchShow())->where("search_id",$this->toArray()['id']);
        $shows_ids = implode(",", array_column($pivots,'show_id'));
        if(empty($shows_ids)){
            return null;
        }
        $shows = (new TvShow())->whereRaw("id in ({$shows_ids})");

        return  array_map(function ($item){
            return (new TvShow())->fill((array)$item);

        },$shows);






    }

}