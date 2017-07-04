<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 07-04-17
 * Time: 12:12 PM
 */

namespace App\Controller;


class TvShowController extends MainController
{

    public function index(){
        return $this->app->view()->show('template/search.php',['hello'=>"name "]);
    }

}