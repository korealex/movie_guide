<?php namespace App\Models;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 07-03-17
 * Time: 11:49 PM
 */
class Image extends BaseModel
{
    protected $table  = 'image';
    protected $fillable  = ['id','subKey','fileName','resolution','show_id','keyType'];
}