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
    protected $fillables  = ['id','firstAired','network','overview','seriesName','status'];


}