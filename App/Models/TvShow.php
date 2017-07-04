<?php namespace App\Models;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 10:56 PM
 */
class TvShow extends BaseModel
{
    protected $table  = 'tvshow';
    protected $fillable  = ['id','firstAired','network','overview','seriesName','status'];

    public function images(){
        return $this->hasMany(Image::class, 'show_id');
    }

    public function episodes(){
        return $this->hasMany(Episode::class);
    }


}