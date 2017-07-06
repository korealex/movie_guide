<?php namespace App\Models;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 07-03-17
 * Time: 11:50 PM
 */
class Episode extends BaseModel
{
    protected $table  = 'episode';
    protected $fillable  = [
        'id','absoluteNumber','airedEpisodeNumber','airedSeason','airedSeasonID','dvdEpisodeNumber','dvdSeason',
        'episodeName','firstAired','lastUpdated','overview','show_id'
        ];

}