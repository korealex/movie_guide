<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 07-04-17
 * Time: 12:12 PM
 */

namespace App\Controller;


class DBController extends MainController
{

    public function query(){

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
        return $e->getMessage();
        }


    }

}